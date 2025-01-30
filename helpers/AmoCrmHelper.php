<?php 

namespace app\helpers;

use Yii;
use app\models\Setting;

class AmoCrmHelper
{
	protected $client_id = null;
	protected $client_secret = null;
	protected $redirect_uri = null;
	protected $subdomain = null;
	protected $auth_code = null;
	protected $access_token = null;
	protected $refresh_token = null;
	protected $expires_in = null;


	public function __construct() {
		$this->client_id = Setting::getSetting('amocrm_client_id');
		$this->client_secret = Setting::getSetting('amocrm_client_secret');
		$this->redirect_uri = Setting::getSetting('amocrm_redirect_uri');
		$this->subdomain = Setting::getSetting('amocrm_subdomain');
		$this->auth_code = Setting::getSetting('amocrm_auth_code');
		$this->access_token = Setting::getSetting('amocrm_access_token');
		$this->refresh_token = Setting::getSetting('amocrm_refresh_token');
		$this->expires_in = Setting::getSetting('amocrm_expires_in');

		$time = time();

		if (!empty($this->auth_code)) {
			$this->getAccessToken();
		} elseif(!empty($this->refresh_token) && $this->expires_in < $time) {
			$this->refreshAccessToken();
		}
	}

	/**
	 * Получение Access токена (boolean)
	 */
	public function getAccessToken() {
		if (!empty($this->auth_code)) {
			$tokenUrl = "https://{$this->subdomain}.amocrm.ru/oauth2/access_token";

			$client = new CurlHelper();

			$response = $client->post($tokenUrl, [
				'client_id' => $this->client_id,
				'client_secret' => $this->client_secret,
				'grant_type' => 'authorization_code',
				'code' => $this->auth_code,
				'redirect_uri' => $this->redirect_uri
				]);

			$data = json_decode($response->body(), true);

			if (!empty($data) && !empty($data['access_token']) && !empty($data['refresh_token']) && !empty($data['expires_in'])) {
				$this->auth_code = null;
				$this->access_token = $data['access_token'];
				$this->refresh_token = $data['refresh_token'];
				$this->expires_in = time() + $data['expires_in'] - 60;

				Setting::setSetting('amocrm_auth_code', $this->auth_code);
				Setting::setSetting('amocrm_access_token', $this->access_token);
				Setting::setSetting('amocrm_refresh_token', $this->refresh_token);
				Setting::setSetting('amocrm_expires_in', $this->expires_in);

				return true;
			}
		}
		return false;
	}

	/**
	 * Замена Access токена (boolean)
	 */
	public function refreshAccessToken() {
		if (!empty($this->refresh_token)) {
			$tokenUrl = "https://{$this->subdomain}.amocrm.ru/oauth2/access_token";

			$client = new CurlHelper();

			$response = $client->post($tokenUrl, [
				'client_id' => $this->client_id,
				'client_secret' => $this->client_secret,
				'grant_type' => 'refresh_token',
				'refresh_token' => $this->refresh_token,
				'redirect_uri' => $this->redirect_uri
				]);

			$data = json_decode($response->body(), true);

			if (!empty($data) && !empty($data['access_token']) && !empty($data['refresh_token']) && !empty($data['expires_in'])) {
				$this->auth_code = null;
				$this->access_token = $data['access_token'];
				$this->refresh_token = $data['refresh_token'];
				$this->expires_in = time() + $data['expires_in'] - 60;

				Setting::setSetting('amocrm_auth_code', $this->auth_code);
				Setting::setSetting('amocrm_access_token', $this->access_token);
				Setting::setSetting('amocrm_refresh_token', $this->refresh_token);
				Setting::setSetting('amocrm_expires_in', $this->expires_in);

				return true;
			}
		}
		return false;
	}

	/**
	 * Создание нового контакта (int)
	 */
	public function createContact($name, $phone, $city, $comment, $pageUrl, $pageName) {
		if (!empty($this->access_token)) {
			$url = "https://{$this->subdomain}.amocrm.ru/api/v4/contacts";

			$client = new CurlHelper();

			$post = array(
				[
					"created_by" => 0
				]
			);

			// if (empty($name) && !empty($phone)) {
			// 	$name = $phone;
			// }
			// if (empty($comment) && !empty($pageName)) {
			// 	$comment = $pageName;
			// }

			if (!empty($name)) {
				$post[0]['name'] = $name;
			}
			$custom_fields = array();
			if (!empty($phone)) {
				$custom_fields[] = array(
					'field_id' => 1342959, 
					'values' => [
						['value' => $phone]
					]
					);
			}
			if (!empty($city)) {
				$custom_fields[] = array(
					'field_id' => 1495823, 
					'values' => [
						['value' => $city]
					]
					);
			}
			if (!empty($comment)) {
				$custom_fields[] = array(
					'field_id' => 1495815, 
					'values' => [
						['value' => $comment]
					]
					);
			}
			if (!empty($pageUrl)) {
				$custom_fields[] = array(
					'field_id' => 1495819, 
					'values' => [
						['value' => $pageUrl]
					]
					);
			}
			if (!empty($_SERVER['HTTP_HOST'])) {
				$custom_fields[] = array(
					'field_id' => 1566864, 
					'values' => [
						['value' => $_SERVER['HTTP_HOST']]
					]
					);
			}
			if (!empty($custom_fields)) {
				$post[0]['custom_fields_values'] = $custom_fields;
			}

			$post = json_encode($post);

			$response = $client->setHttpheader([
					"Authorization: Bearer {$this->access_token}",
					"Content-Type: application/json"
				])->post($url, $post);

			if ($response = $response->body()) {
				$response = json_decode($response, true);
				if (!empty($response['_embedded']) && !empty($response['_embedded']['contacts']) && !empty($response['_embedded']['contacts'][0]) && !empty($response['_embedded']['contacts'][0]['id'])) {
					return $response['_embedded']['contacts'][0]['id'];
				}
			}
		}
		return false;
	}


	/**
	 * Создание новой заявки (int)
	 */
	public function createLead($contactID) {
		if (!empty($this->access_token)) {
			$url = "https://{$this->subdomain}.amocrm.ru/api/v4/leads";

			$client = new CurlHelper();

			$post = array(
				[
					"created_by" => 0,
					"_embedded" => [
						"contacts" => [
							[
								"id" => $contactID
							]
						]
					]
				]
			);
			$post = json_encode($post);

			$response = $client->setHttpheader([
					"Authorization: Bearer {$this->access_token}",
					"Content-Type: application/json"
				])->post($url, $post);

			if ($response = $response->body()) {
				$response = json_decode($response, true);
				if (!empty($response['_embedded']) && !empty($response['_embedded']['leads']) && !empty($response['_embedded']['leads'][0]) && !empty($response['_embedded']['leads'][0]['id'])) {
					return $response['_embedded']['leads'][0]['id'];
				}
			}
		}
		return false;
	}

	/**
	 * Создаем заявку с прикрепленным контактом (int)
	 */
	public function createLeadWithContact($name, $phone, $city, $comment, $pageUrl, $pageName) {
		$contactID = $this->createContact($name, $phone, $city, $comment, $pageUrl, $pageName);
        if (!empty($contactID)) {
            return $this->createLead($contactID);
        }
        return false;
	}


}




?>