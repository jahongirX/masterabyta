<?php 

namespace app\helpers;

use Yii;

class CurlHelper
{
	protected $cookie_dir = null;       // адрес папки с файлами для хранения куки
	protected $cookie_file = null;      // адрес файла для хранения куки для cURL запросов
	protected $useragent = 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'; // браузер "пользователя"
	protected $ch = null;               // сессия cURL
	protected $url = null;              // URL адрес запроса
	protected $post_param = null;       // массив POST параметров
	protected $httpheader = array();    // HTTP заголовки запроса (array)
	protected $save_header = false;     // сохранять ли заголовки ответа? (boolean)
	protected $save_cookie = true;      // сохранять ли cookie? (boolean)

	protected $proxy_ip = null;         // Прокси IP
	protected $proxy_port = null;       // Прокси порт
	protected $proxy_login = null;      // Прокси логин
	protected $proxy_pass = null;       // Прокси пароль

	protected $httpcode = null;         // HTTP код ответа
	protected $header = null;           // заголовки ответа
	protected $response = null;         // ответ от сервера
	protected $err = null;              // текст ошибки
	protected $location = null;         // итоговый адрес страницы после всех редиректов
	protected $time = null;             // продолжительность выполнения запроса

	protected $cookie_string = null;    // передаем одноразовые куки из строки (без записи)

	public function __construct() {
		$this->change_cookie_file();
		return $this;
	}

	/**
	 * Создаем новый экземпляр класса
	 */
	public static function newObj() {
		return new static();
	}

	/**
	 * Меняем файл для записи cookie
	 * $url - Адрес запроса (string)
	 */
	public function change_cookie_file($url = null){
		if (!empty($url)) {
			$cookie_filename = preg_replace('/^(https?:)?(\/\/)?(www\.)?/', '', $url);
			$cookie_filename = preg_replace('/\/.+$/', '', $cookie_filename);
		}
		if (empty($cookie_filename)) {
			$cookie_filename = 'curl.txt';
		} else {
			$cookie_filename .= '.txt';
		}
		$this->cookie_dir = __DIR__ . '/cookie';
		if(!file_exists($this->cookie_dir)){
			@mkdir($this->cookie_dir, 0777, true);
		}
		$this->cookie_file = $this->cookie_dir . '/' . $cookie_filename;
		if (!file_exists($this->cookie_file)) {
			@file_put_contents($this->cookie_file, '', LOCK_EX);
		}
		return $this;
	}

	/**
	 * Меняем GET параметры в URL адресе
	 * $url - URL адрес со старыми GET параметрами (string)
	 * $get - массив новых GET параметров (array)
	 */
	public static function edit_get_param($url, $get = null){
		if (!empty($url) && !empty($get) && is_array($get)) {
			// меняем значения GET параметров
			$arr = array();
			$url = explode('?', $url, 2);
			if (!empty($url[1])) {
				$param = explode('&', $url[1]);
				if (!empty($param) && is_array($param)) {
					foreach ($param as $one) {
						$one_param = explode('=', $one, 2);
						if (!empty($one_param) && !empty($one_param[0])) {
							if (!isset($get[$one_param[0]])) {
								$arr[] = $one;
							}
						}
					}
				}
			}
			foreach ($get as $key => $value) {
				$arr[] = $key .'='. $value;
			}
			$url = $url[0] .'?'. implode('&', $arr);
		}
		return $url;
	}

	/**
	 * Стартуем cURL
	 */
	protected function start() {		
		$this->ch = curl_init();                                               // открываем cURL сессию
		curl_setopt($this->ch, CURLOPT_HEADER, $this->save_header);            // сохранять ли заголовки ответа? (boolean)
		curl_setopt($this->ch, CURLOPT_USERAGENT, $this->useragent);           // браузер "пользователя"

		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);                  // следование любому заголовку "Location: ", отправленному сервером в своем ответе (учтите, что это происходит рекурсивно, PHP будет следовать за всеми посылаемыми заголовками "Location: ", за исключением случая, когда установлена константа CURLOPT_MAXREDIRS)
		curl_setopt($this->ch, CURLOPT_AUTOREFERER, true);                     // автоматическая установка поля Referer: в запросах, перенаправленных заголовком Location:.

		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);                  // сохраняем полученные данные

		if (!empty($this->save_cookie) && file_exists($this->cookie_file)) {
			curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookie_file);     // получаем куки от сервера
		}

		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);                 // Отключить ошибку "SSL certificate problem, verify that the CA cert is OK"
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);                 // Отключить ошибку "SSL: certificate subject name 'hostname.ru' does not match target host name '123.123'"

		if (!empty($this->httpheader)) {
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->httpheader);     // передаем HTTP заголовки
		}

		if (!empty($this->save_cookie) && file_exists($this->cookie_file)) {
			curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookie_file);    // передаем куки при запросе
			clearstatcache(true, $this->cookie_file);
		}

		if (!empty($this->cookie_string)) {
			curl_setopt($this->ch, CURLOPT_COOKIE, $this->cookie_string);    // передаем куки (из строки) при запросе
		}

		if (!empty($this->proxy_ip) && !empty($this->proxy_port)) {
			$proxy = $this->proxy_ip .':'. $this->proxy_port;
			curl_setopt($this->ch, CURLOPT_PROXY, $proxy);                     // подключение к прокси-серверу
			if (!empty($this->proxy_login)) {
				$proxyauth = $this->proxy_login .':'. $this->proxy_pass;
				curl_setopt($this->ch, CURLOPT_PROXYUSERPWD, $proxyauth);      // если требуется авторизация
			}
		}
	}

	/**
	 * Выполняем запрос cURL для открытой сессии
	 */
	protected function query() {
		$timestamp_start = microtime(true);
		curl_setopt($this->ch, CURLOPT_URL, $this->url);
		$this->response = curl_exec($this->ch);                                // получаем данные от сервера

		$timestamp_finish = microtime(true);
		$this->time = $timestamp_finish - $timestamp_start;

		if (!empty($this->save_header) && $this->response !== false) {
			$ch_info = curl_getinfo($this->ch);
			$this->header = substr($this->response, 0, $ch_info['header_size']);
			$this->response = substr($this->response, $ch_info['header_size']);
		}

		$this->location = curl_getinfo($this->ch, CURLINFO_EFFECTIVE_URL);

		$this->err = curl_error($this->ch);                                    // получаем ошибки cURL
		$this->httpcode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);         // получаем статус ответа
		if($this->httpcode !== 200 && $this->httpcode !== 201){
			return false;
		}
		if($this->err){
			return false;
		}
		return true;
	}

	/**
	 * Закрываем сессию cURL
	 */
	protected function close() {		
		curl_close($this->ch);
	}

	/**
	 * Устанавливаем proxy для выполнения запроса
	 * $ip - прокси IP (string)
	 * $port - прокси порт (string)
	 * $login - прокси логин (string)
	 * $pass - прокси пароль (string)
	 */
	public function proxy($ip, $port, $login = null, $pass = null) {
		if (!empty($ip)) {
			$this->proxy_ip = $ip;
		}
		if (!empty($port)) {
			$this->proxy_port = $port;
		}
		if (!empty($login)) {
			$this->proxy_login = $login;
		}
		if (!empty($pass)) {
			$this->proxy_pass = $pass;
		}
		return $this;
	}

	/**
	 * Устанавливаем HTTP заголовки
	 * $httpheader - HTTP заголовки (array)
	 */
	public function setHttpheader($httpheader) {
		if (!empty($httpheader) && is_array($httpheader)) {
			$this->httpheader = array_merge($this->httpheader, $httpheader);
		}
		return $this;
	}

	/**
	 * Устанавливаем Useragent
	 * $useragent - браузер "пользователя" (string)
	 */
	public function setUseragent($useragent) {
		if (!empty($useragent)) {
			$this->useragent = $useragent;
		}
		return $this;
	}

	/**
	 * Сохраняем заголовки ответа
	 */
	public function saveHeader() {
		$this->save_header = true;
		return $this;
	}

	/**
	 * Не передаем и не записываем cookie
	 */
	public function withoutCookie() {
		$this->save_cookie = false;
		return $this;
	}

	/**
	 * Устанавливаем файл для чтения и записи cookie
	 * $filename - имя файла для чтения и записи cookie (string)
	 */
	public function setCookiefile($filename) {
		if (!empty($filename) && is_array($filename)) {
			$this->cookie_file = $this->cookie_dir . '/' . $filename;
			if (!file_exists($this->cookie_file)) {
				@file_put_contents($this->cookie_file, '', LOCK_EX);
			}
		}
		return $this;
	}

	/**
	 * Выполняем запрос методом GET
	 * $url - URL адрес запроса (string)
	 * $param - массив GET параметров (array)
	 */
	public function get($url, $param = null) {
		$this->url = $url;
		$this->change_cookie_file($this->url);
		if (!empty($param) && is_array($param)) {
			$this->url = CurlHelper::edit_get_param($this->url, $param);
		}
		$this->start();
		$this->query();
		$this->close();
		return $this;
	}

	/**
	 * Выполняем запрос методом POST
	 * $url - URL адрес запроса (string)
	 * $param - массив POST параметров (array)
	 */
	public function post($url, $param = null) {
		$this->url = $url;
		$this->change_cookie_file($this->url);
		$this->post_param = $param;
		$this->start();
		curl_setopt($this->ch, CURLOPT_POST, true);
		if (!empty($this->post_param)) {
			// передаем POST параметры
			if (is_array($this->post_param)) {
				curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($this->post_param));
			} else {
				curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->post_param);
			}
		}
		$this->query();
		$this->close();
		return $this;
	}

	/**
	 * Получаем код ответа последнего запроса
	 */
	public function code() {
		return $this->httpcode;
	}

	/**
	 * Получаем тело ответа последнего запроса
	 */
	public function body() {
		return $this->response;
	}

	/**
	 * Получаем сообщение об ошибке последнего запроса
	 */
	public function error() {
		return $this->err;
	}

	/**
	 * Получаем заголовки ответа последнего запроса
	 */
	public function header() {
		return $this->header;
	}

	/**
	 * Получаем конечный адрес запрашиваемой страницы (после редиректов)
	 */
	public function location() {
		return $this->location;
		
		// preg_match('/Location:(.*?)\n/', $this->header, $matches);
		// if (!empty($matches) && is_array($matches)) {
		// 	return array_pop($matches);
		// }
		// return $this->url;
	}

	/**
	 * Получаем время (продолжительность) выполнения последнего запроса
	 */
	public function time() {
		return $this->time;
	}


	public function set_cookie_string($cookie_string) {
		$this->cookie_string = $cookie_string;
		return $this;
	}

}




?>