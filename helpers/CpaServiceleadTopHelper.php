<?php 

namespace app\helpers;

use Yii;

class CpaServiceleadTopHelper
{

	public static $branches = array(
		164 => "Абакан",
		521 => "Азов",
		103 => "Альметьевск",
		113 => "Ангарск",
		301359 => "Ангарск",
		151 => "Армавир",
		50 => "Архангельск",
		32 => "Астрахань",
		146 => "Ачинск",
		119 => "Балаково",
		24 => "Барнаул",
		42 => "Белгород",
		147 => "Бердск",
		173 => "Березники",
		97 => "Бийск",
		123 => "Благовещенск",
		124 => "Братск",
		48 => "Брянск",
		55 => "Великий Новгород",
		64 => "Витебск",
		33 => "Владивосток",
		71 => "Владимир",
		17 => "Волгоград",
		152 => "Волгодонск",
		58 => "Вологда",
		18 => "Воронеж",
		53 => "Гомель",
		512 => "Дзержинск",
		140 => "Димитровград",
		545 => "Долгопрудный",
		3 => "Екатеринбург",
		116 => "Елец",
		101360 => "Зеленодольск",
		127 => "Златоуст",
		39 => "Иваново",
		30 => "Иркутск",
		174 => "Йошкар-Ола",
		10 => "Казань",
		27 => "Калининград",
		40 => "Калуга",
		101 => "Каменск-Уральский",
		25 => "Кемерово",
		61 => "Киров",
		131 => "Ковров",
		122 => "Комсомольск-на-Амуре",
		100 => "Сызрань",
		548 => "Королев",
		59 => "Кострома",
		549 => "Красногорск",
		14 => "Краснодар",
		8 => "Красноярск",
		90 => "Курган",
		41 => "Курск",
		43 => "Липецк",
		23 => "Магнитогорск",
		105 => "Миасс",
		181 => "Минеральные Воды",
		44 => "Минск",
		91 => "Могилев",
		36 => "Москва",
		45 => "Мурманск",
		143 => "Муром",
		20 => "Набережные Челны",
		130 => "Находка",
		121 => "Нижневартовск",
		171 => "Нижнекамск",
		1 => "Нижний Новгород",
		69 => "Нижний Тагил",
		26 => "Новокузнецк",
		135 => "Новомосковск",
		95 => "Новороссийск",
		4 => "Новосибирск",
		520 => "Новочеркасск",
		144 => "Новошахтинск",
		513651 => "Ногинск",
		125 => "Норильск",
		136 => "Обнинск",
		7 => "Омск",
		37 => "Орел",
		19 => "Оренбург",
		118 => "Орск",
		102 => "Первоуральск",
		9 => "Пермь",
		54 => "Петрозаводск",
		150 => "Прокопьевск",
		57 => "Псков",
		513629 => "Раменское",
		13 => "Ростов-на-Дону",
		99 => "Рыбинск",
		34 => "Рязань",
		128 => "Салават",
		2 => "Самара",
		0 => "Санкт-Петербург",
		65 => "Саранск",
		12 => "Саратов",
		38 => "Севастополь",
		114 => "Северск",
		51 => "Симферополь",
		63 => "Смоленск",
		28 => "Сочи",
		62 => "Ставрополь",
		52 => "Стерлитамак",
		70 => "Сургут",
		163 => "Сыктывкар",
		66 => "Таганрог",
		79 => "Тамбов",
		29 => "Тверь",
		11 => "Тольятти",
		16 => "Томск",
		49 => "Тула",
		6 => "Тюмень",
		160 => "Улан-Удэ",
		22 => "Ульяновск",
		126 => "Уссурийск",
		15 => "Уфа",
		47 => "Хабаровск",
		149 => "Ханты-Мансийск",
		46 => "Чебоксары",
		5 => "Челябинск",
		60 => "Череповец",
		161 => "Чита",
		107 => "Шахты",
		513659 => "Щелково",
		110 => "Электросталь",
		221 => "Энгельс",
		162 => "Якутск",
		31 => "Ярославль",
		182 => "Евпатория"
		);

	/**
	 * Получаем ID города (int)
	 * $branch_id - название города (string)
	 */
	public static function getBranchId($cityName) {
		if (!empty($cityName)) {
			$branches = static::$branches;
			$branches = array_flip($branches);
			if (!empty($branches) && is_array($branches) && isset($branches[$cityName])) {
				return $branches[$cityName];
			}
		}
		return null;
	}

	/**
	 * Передача заявок по API
	 * $token - токен клиента, обязательно
	 * $phone - номер клиента, обязательно
	 * $branch_id - id города, обязательно
	 * $offer_id - id оффера, обязательно
	 * $thread_id - id потока, не обязательно
	 */
	public static function apiSend($token, $phone, $name, $cityName, $offer_id, $thread_id = null) {
		$branch_id = static::getBranchId($cityName);

		if (empty($name)) {
			$name = 'Без имени';
		}

		if (!empty($token) && !empty($phone) && $branch_id !== null) {
			$phone_number = preg_replace('/\D/', '', $phone);
			$phone = preg_replace('/^9/', '79', $phone);
			$phone = preg_replace('/^80/', '780', $phone);
			$phone = preg_replace('/^81/', '781', $phone);
			$phone = preg_replace('/^82/', '782', $phone);
			$phone = preg_replace('/^83/', '73', $phone);
			$phone = preg_replace('/^84/', '74', $phone);
			$phone = preg_replace('/^85/', '785', $phone);
			$phone = preg_replace('/^86/', '786', $phone);
			$phone = preg_replace('/^87/', '787', $phone);
			$phone = preg_replace('/^88/', '78', $phone);
			$phone = preg_replace('/^89/', '79', $phone);
			$phone = preg_replace('/^3/', '73', $phone);
			$phone = preg_replace('/^4/', '74', $phone);

			$params = array(
				//  'direction_id' => 1, //  ОБЯЗАТЕЛЬНО, если не указан offer_id
				'offer_id' => $offer_id, //  ОБЯЗАТЕЛЬНО, если не указан direction_id
				'branch_id' => $branch_id, //  id города (ОБЯЗАТЕЛЬНО)
				'phones' => [
					$phone_number, //  Телефон клиента (ОБЯЗАТЕЛЬНО)
				],

				//  Из двух строк ниже оставьте только одну, нужную вам! Остальные удалите или закомментируйте.
				'is_pm' => false, //  Не частный мастер (ОБЯЗАТЕЛЬНО)
				// 'is_pm' => true, //  Частный мастер (ОБЯЗАТЕЛЬНО)

				'name' => $name,  //  ФИО клиента (ОБЯЗАТЕЛЬНО)
				// 'description' => 'Test order', //  Описание работ
				'client_ip' => $_SERVER['REMOTE_ADDR'],
			);

			if (!empty($thread_id)) {
				$params['thread_id'] = $thread_id;
			}

			$url = "https://newapi.ru/lead?source=partner&idp=".$token;

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