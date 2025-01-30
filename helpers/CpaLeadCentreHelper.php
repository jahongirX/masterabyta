<?php 

namespace app\helpers;

use Yii;

class CpaLeadCentreHelper
{

	public static $branches = array(
		'Владивосток' => 1,
		'Пермь' => 21,
		'Ялта' => 335,
		'Астрахань' => 13,
		'Барнаул' => 22,
		'Белгород' => 159,
		'Благовещенск' => 274,
		'Великий Новгород' => 188,
		'Владимир' => 59,
		'Волгоград' => 12,
		'Волжский' => 161,
		'Вологда' => 197,
		'Воронеж' => 27,
		'Евпатория' => 276,
		'Иваново' => 57,
		'Ижевск' => 8,
		'Иркутск' => 5,
		'Казань' => 19,
		'Калининград' => 18,
		'Калуга' => 163,
		'Кемерово' => 25,
		'Киров' => 41,
		'Краснодар' => 10,
		'Красноярск' => 3,
		'Курган' => 187,
		'КЦ' => 39,
		'Липецк' => 52,
		'Набережные Челны' => 35,
		'Нижний Новгород' => 20,
		'Нижний Тагил' => 195,
		'Новокузнецк' => 28,
		'Новороссийск' => 185,
		'Новосибирск' => 14,
		'Омск' => 15,
		'Орёл' => 196,
		'Оренбург' => 7,
		'Орск' => 215,
		'Псков' => 203,
		'Ростов-на-Дону' => 11,
		'Рязань' => 26,
		'Самара' => 24,
		'Санкт-Петербург' => 325,
		'Саранск' => 165,
		'Саратов' => 32,
		'Севастополь' => 53,
		'Симферополь' => 180,
		'Сочи' => 162,
		'Ставрополь' => 40,
		'Сургут' => 37,
		'Тверь' => 51,
		'Тольятти' => 31,
		'Томск' => 4,
		'Тула' => 30,
		'Тюмень' => 17,
		'Улан-Удэ' => 6,
		'Ульяновск' => 34,
		'Уфа' => 23,
		'Хабаровск' => 2,
		'Чебоксары' => 38,
		'Челябинск' => 9,
		'Череповец' => 184,
		'Чита' => 49,
		'Ярославль' => 29
		);

	/**
	 * Получаем ID города (int)
	 * $branch_id - название города (string)
	 */
	public static function getBranchId($cityName) {
		if (!empty($cityName)) {
			$branches = static::$branches;
			if (!empty($branches) && is_array($branches) && isset($branches[$cityName])) {
				return $branches[$cityName];
			}
		}
		return null;
	}

	/**
	 * Передача заявок по API (int|null)
	 * $token - токен авторизации (string)
	 * $phone - номер клиента (string)
	 * $name - имя клиента (string)
	 * $cityName - название (string)
	 * $description - комментарий (string)
	 * $pageName - название страницы (string)
	 */
	public static function apiSend($token, $phone, $name, $cityName, $description, $pageName = null) {
		$branch_id = static::getBranchId($cityName);

		if (empty($name)) {
			// $name = 'Без имени';
			$name = $phone;
		}
		$name_strlen = mb_strlen($name);
		if ($name_strlen < 3 || $name_strlen > 150) {
			$name = 'Без имени';
		}

		if (empty($description)) {
			if (!empty($pageName)) {
				$description = $pageName;
			} else {
				$description = '';
			}
		}
		$description .= ' ('.$phone.')';
		$description_strlen = mb_strlen($description);
		if ($description_strlen > 2000) {
			$description = mb_substr($description, 0, 2000);
		}

		if (!empty($phone)) {
			$phone_first1 = mb_substr($phone, 0, 1);
			$phone_first2 = mb_substr($phone, 0, 2);
			if ($phone_first2 !== '+7') {
				if ($phone_first1 === '7') {
					$phone = '+'.$phone;
				} elseif ($phone_first1 === '8') {
					$phone = '+7'.preg_replace('/^8/', '', $phone);
				} else {
					$phone = '+7'.$phone;
				}
			}

			$phone_strlen = mb_strlen($phone);
			if ($phone_strlen < 12) {
				$phone = str_pad($phone, 12, '0');
			}
			if ($phone_strlen > 12) {
				$phone = mb_substr($phone, 0, 12);
			}
		}


		if (!empty($token) && !empty($phone) && $branch_id !== null) {
			$token = base64_encode($token);
			$params = array(
				"city_id" => $branch_id,
				"customer_phone" => $phone,
				"customer_name" => $name,
				"description" => $description
			);

			$url = "https://bt-lead-centre.ru/api/customer-request/create";

			$curl = curl_init();
			curl_setopt_array($curl, [
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode($params, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
				CURLOPT_HTTPHEADER => [
					"Authorization: Basic {$token}",
					"Content-Type: application/json"
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