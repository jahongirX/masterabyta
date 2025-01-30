<?php 

namespace app\helpers;

use Yii;

class CpaRukiIzPlechHelper
{

	/**
	 * Передача заявок по API
	 * $token - токен клиента, обязательно
	 * $phone - номер клиента, обязательно
	 * $message - комментарий, не обязательно
	 */
	public static function apiSend($token, $phone, $message = null) {
		if (!empty($token) && !empty($phone)) {
			$curl = curl_init();
			$data = array(
				"phone" => $phone
			);
			if (!empty($message)) {
				$data['message'] = $message;
			}
			curl_setopt_array($curl, [
				CURLOPT_URL            => "https://cpa.ruki-iz-plech.ru/api/leads/create",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => "",
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 30,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => "POST",
				CURLOPT_POSTFIELDS     => json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
				CURLOPT_HTTPHEADER     => [
					"auth: {$token}",
					"content-type: application/json",
				],
			]);

			$response = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			$err = curl_error($curl);

			curl_close($curl);

			return $httpcode;
		}
		return null;
	}

}




?>