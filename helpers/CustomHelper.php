<?php

namespace app\helpers;

use Yii;
use yii\helpers\Url;

use app\models\Setting;

class CustomHelper
{

	/**
	 * Фильтр E-mail (string)
	 * $var - проверяемое значение (string)
	 */
	public static function filter_email($var){
	  $var = trim($var);
	  $exp = "/^[\w-\.]+@[\w-\.]+\.[a-zA-Z]{2,4}$/";
	  if(preg_match($exp, $var)){
	  	return $var;
	  }else{
	  	return false;
	  }
	}


	/**
	 * Формат стоимости (string)
	 * $number - сумма (int)
	 * $rub - выводить знак рубля (boolean)
	 */
	public static function price_format($number, $rub = FALSE){
	  $number = (float) $number;
	  $number_int = (int) $number;
	  if($number == $number_int){
	  	$number = number_format($number, 0, '.', '</span><span class="number-delimiter">');
	  }else{
	  	$number = number_format($number, 2, '.', '</span><span class="number-delimiter">');
	  }
	  $number = '<span class="number-delimiter">' . $number . '</span>';
	  $number = '<span class="number-format">' . $number . '</span>';
	  // if(!empty($rub) && !empty(Yii::$app->params['currency-symbol'])){
	  // 	$number .= Yii::$app->params['currency-symbol'];
	  // }
	  if(!empty($rub)){
	  	$number .= 'руб.';
	  }
	  return $number;
	}



	/**
	 * Активный пункт меню (boolean)
	 * $var - название контроллера (string)
	 */
	public static function AdminActiveMenuPoint($var){
		$controllerName = Yii::$app->controller->id;
		if($controllerName === $var){
			return true;
		}
		return false;
	}



	/**
	 * Распечатка массива/объекта
	 * $arr - массив (array)
	 * $charset - выводить ли заголовки с кодировкой (boolean)
	 */
	public static function debug($arr, $charset=FALSE){
		if($charset) header('Content-Type: text/html; charset=UTF-8');
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
		exit;
	}



	/**
	 * Вывод ссылки на телефон (string)
	 * $var - номер телефона (string)
	 */
	public static function phone_link($var){
		$res = preg_replace('/\D/', '', $var);
		$first = substr($res, 0, 1);
		if($first == 7) $res = '+'.$res;
		return $res;
	}



	/**
	 * Выводим текст без форматирования в исходном варианте
	 * $var - исходный текст (string)
	 */
	public static function custom_default($var){
		return $var;
	}



	/**
	 * Выводим переносы строк <br> (string)
	 * $var - исходный текст (string)
	 */
	public static function custom_br($var){
		// $res = preg_replace("/\\\r\\\n/", '<br>', $var);
		$res = str_replace(["\r\n", "\r", "\n"], '<br>', $var);
		return $res;
	}



	/**
	 * Удаляем переносы строк (string)
	 * $var - исходный текст (string)
	 */
	public static function custom_inline($var){
		$res = preg_replace("/\s+/", " ", $var);
		$res = htmlspecialchars($res);
		return trim($res);
	}



	/**
	 * Выводим форматирование в виде параграфов
	 * $var - исходный текст (string)
	 */
	public static function custom_paragraph($var){
		$res = '<p>'. str_replace(["\r\n", "\r", "\n"], "</p><p>", $var) .'</p>';
		return $res;
	}



	public static function custom_content($var){
		$res = static::custom_br($var);
		$res = '<p>'. preg_replace("@(<br\s?\\?>\s?){2,}@", "</p><p>", $res) .'</p>';
		return $res;
	}



	/**
	 * Выводим форматирование в виде списка
	 * $var - исходный текст (string)
	 */
	public static function custom_list($var){
		$res = '<li>'. str_replace(["\r\n", "\r", "\n"], "</li><li>", $var) .'</li>';
		return $res;
	}



	/**
	 * Выводим форматирование в виде массива
	 * $var - исходный текст (string)
	 */
	public static function custom_text_to_array($var){
		$arr = array();
		if (!empty($var)) {
			$var = preg_replace("/(\r\n)+|(\r)+|(\n)+/", '\r\n', $var);
			$arr = explode('\r\n', $var);
		}
		return $arr;
	}



	/**
	 * Выводим надпись из БД
	 * $id - ID надписи (int)
	 * $param - массив параметров для подстановки в надпись (array)
	 */
	public static function custom_inscription($id, $param = null){
		if(isset(Yii::$app->params['inscriptions'][$id])){
			$string = Yii::$app->params['inscriptions'][$id];
			if(is_array($param)){
				foreach ($param as $key => $value) {
					if($key){
						$key = '{'.$key.'}';
						$string = str_replace($key, $value, $string);
					}
				}
			}
			return $string;
		}else{
			return '';
		}
	}



	/**
	 * Выводим надпись из БД
	 * $config - ключ массива параметров конфигурации (string)
	 * $config_id - ID массива параметров конфигурации (int)
	 * $inscription_id - ID надписи (int)
	 */
	public static function custom_inscription_config($config, $config_id, $inscription_id){
		if(isset(Yii::$app->params[$config][$config_id]) && !empty(Yii::$app->params[$config][$config_id])){
			Yii::$app->params[$config][$config_id] = Yii::$app->params['inscriptions'][$inscription_id];
			return true;
		}
		return false;
	}



	/**
	 * Текстовое превью (string)
	 * $text - исходный текст (string)
	 * $size - размер превью в символах (int)
	 */
	public static function custom_excerpt($text, $size=150){
		$text = strip_tags($text);
		$text_size = mb_strlen($text);
		$text = mb_substr($text, 0, $size);
		if($text_size > 150) $text .= '...';
		return $text;
	}



	/**
	 * Звездный рейтинг (string)
	 * $rating - рейтинг (int)
	 */
	public static function custom_star_rating($rating){
		$res = '';
		$rating = abs( (int) $rating );
		if($rating > 5) $rating = 5;
		for ($i=0; $i < $rating; $i++) { 
			$res .= '<li class="ico-star"></li>';
		}
		// for ($i=$rating; $i < 5; $i++) { 
		// 	$res .= '<li class="ico-star-empty"></li>';
		// }
		return $res;
	}



	/**
	 * Преобразуем объект в массив (array)
	 * $data - исходный объект (object | array)
	 */
	public static function object_to_array($data)
	{
	    if (is_array($data) || is_object($data))
	    {
	        $result = array();
	        foreach ($data as $key => $value)
	        {
	            $result[$key] = static::object_to_array($value);
	        }
	        return $result;
	    }
	    return $data;
	}



	/**
	 * Отметка selected в выпадающем списке (string)
	 * $var_1 - ожидаемое значение/массив значений (int | string | boolean | array)
	 * $var_2 - текущее значение (int | string | boolean)
	 */
	public static function selected($var_1, $var_2){
		$res = '';
		if(is_array($var_1)){
			if(in_array($var_2, $var_1)) $res = 'selected';
		}else{
			if($var_1 == $var_2) $res = 'selected';
		}
		return $res;
	}



	/**
	 * Отмеченный чекбокс
	 * $var_1 - ожидаемое значение/массив значений (int | string | boolean | array)
	 * $var_2 - текущее значение (int | string | boolean)
	 */
	public static function checked($var_1, $var_2){
		$res = '';
		if(is_array($var_1)){
			if(in_array($var_2, $var_1)) $res = 'checked';
		}else{
			if($var_1 == $var_2) $res = 'checked';
		}
		return $res;
	}



	/**
	 * Задаем собственный класс для активного элемента (string)
	 * $current - текущее значение (int | string | boolean)
	 * $proper - ожидаемое значение/массив значений (int | string | boolean | array)
	 * $text - строка, возвращаемая в случае успеха (string)
	 */
	public static function custon_active_item($current, $proper, $text = 'active'){
		$res = false;
		if(!isset($current)){
			return $res;
		}
		if(is_array($proper)){
			if(in_array($current, $proper)){
				$res = $text;
			}
		}else{
			if($current == $proper){
				$res = $text;
			}
		}
		return $res;
	}




	/**
	 * Получаем размер бонуса (float)
	 * $amount - сумма (float)
	 * $bonuses - массив с процентами бонусов, в зависимости от суммы (array)
	 */
	public static function bonuse_count($amount, $bonuses){
		$percent = 0;
		if(is_array($bonuses)){
			foreach ($bonuses as $key => $value) {
				if($amount >= $key){
					$percent = $value;
				}
			}
		}
		$res = $amount * $percent / 100;
		return round($res);
	}




	/**
	 * Получаем стоимость, в зависимости от количества заказа
	 * $quantity - количество заказа (int)
	 * $price - прайс на услугу (array) в формате [количество] => [цена за 1000]
	 */
	public static function cost_of_price($quantity, $price){
		$cost = 0;
		$quantity = (int) $quantity;
		if(is_array($price)){
			foreach ($price as $key => $value) {
				if($key > $quantity){
					if($cost > 0) break;
				}
				$cost = $value;
			}
		}
		return $cost * $quantity / 1000;
	}



	/**
	 * Получаем массив с произвольными параметрами (array)
	 * $keys - массив с ключами (array)
	 * $values - массив значений (array)
	 * $param - название параметра (string | false)
	 */
	public static function custom_param_arr($keys, $values, $param = false){
		$res = array();
		if(is_array($keys)){
			if(!empty($param)){
				foreach ($keys as $key) { 
					if(isset($values[$key][$param])){
						$res[] = $values[$key][$param];
					}
				}
			}else{
				foreach ($keys as $key) { 
					if(isset($values[$key])){
						$res[] = $values[$key];
					}
				}
			}
		}
		return $res;
	}





	/**
	 * Преобразуем первый символ в верхний регистр (string)
	 * $string - исходная строка (string)
	 * $enc - кодировка (string)
	 */
	public static function mb_ucfirst($string, $enc = 'UTF-8'){
		return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc) . mb_strtolower(mb_substr($string, 1, mb_strlen($string, $enc), $enc));
	}




	/**
	 * Получаем настройки месяца (sting)
	 * $month - номер месяца (int) [1 - 12]
	 * $full - вернуть полное название или сокращенное (boolean)
	 */
	public static function custom_name_month($month, $full = false){
		$month = abs((int)$month);
		if($month<1 || $month>12) return false;

		$arr = array(
			'1' => 'Янв.',
			'2' => 'Фев.',
			'3' => 'Мар.',
			'4' => 'Апр.',
			'5' => 'Май.',
			'6' => 'Июн.',
			'7' => 'Июл.',
			'8' => 'Авг.',
			'9' => 'Сен.',
			'10' => 'Окт.',
			'11' => 'Ноя.',
			'12' => 'Дек.'
		);

		$arr_full = array(
			'1' => 'Январь',
			'2' => 'Февраль',
			'3' => 'Март',
			'4' => 'Апрель',
			'5' => 'Май',
			'6' => 'Июнь',
			'7' => 'Июль',
			'8' => 'Август',
			'9' => 'Сентябрь',
			'10' => 'Октябрь',
			'11' => 'Ноябрь',
			'12' => 'Декабрь'
		);
		if($full){
			$res = $arr_full[$month];
		}else{
			$res = $arr[$month];
		}
		return $res;
	}



	/**
	 * Формат даты текстом (string)
	 * $time - метка времени (int)
	 * $full - полное название месяца или сокращенное (boolean)
	 */
	public static function custom_date_text($time = null, $full = false){
		if(empty($time)) return null;
		$day = date('j', $time);
		$month = date('n', $time);
		$month = static::custom_name_month($month, $full);
		$year = date('Y', $time);
		$res = $day.' '.$month.' '.$year;
		return $res;
	}



	/**
	 * Формат даты (string)
	 * $time - метка времени (int)
	 */
	public static function custom_date($time = null){
		if(empty($time)) return null;
		$res = date('d.m.Y', $time);
		return $res;
	}


	/**
	 * Формат времени (string)
	 * $time - метка времени (int)
	 */
	public static function custom_time($time = null){
		if(empty($time)) return null;
		$res = date('H:i', $time);
		return $res;
	}


	/**
	 * Формат даты и времени (string)
	 * $time - метка времени (int)
	 */
	public static function custom_datetime($time = null){
		if(empty($time)) return null;
		$res = date('d.m.Y H:i', $time);
		return $res;
	}


	/**
	 * Формат даты и времени (string)
	 * $time - метка времени (int)
	 */
	public static function custom_admin_datetime($time = null){
		if(empty($time)) return null;
		$res1 = date('d.m.Y', $time);
		$res2 = date('H:i', $time);
		$res = $res1 . ' <span class="small">(' . $res2 . ')</span>';
		return $res;
	}


	/**
	 * Переводим дату в timestamp
	 * $date - дата в формате 'd.m.Y' (string)
	 * $time - время в формате 'H:i' (string | null)
	 */
	public static function custom_timestamp($date, $time = null){
		preg_match_all('/^(\d{2})\.(\d{2})\.(\d{4})\z/', $date, $arr);
		if(isset($arr[0][0])){
			if($time){
				preg_match_all('/^(\d{2})\ *: *(\d{2})\z/', $time, $arr_time);
			}
			if(isset($arr_time[1][0])){
				$hour = $arr_time[1][0];
			}else{
				$hour = 0;
			}
			if(isset($arr_time[2][0])){
				$minute = $arr_time[2][0];
			}else{
				$minute = 0;
			}
			$second = 0;
			$day = $arr[1][0];
			$month = $arr[2][0];
			$year = $arr[3][0];
			return mktime($hour, $minute, $second, $month, $day, $year);
		}else{
			return false;
		}
	}


	/**
	 * Получаем ссылку на изображение во front-end (string)
	 * $dir - название директории (string)
	 * $id - ID записи (int)
	 * $param - название поля с изображением (string)
	 * $image - название изображения (string)
	 */
	public static function custom_front_image_url($dir, $id, $param, $image){
		return $image;
		// if($dir && $id && $param && $image){
		// 	return '/upload/custom/' .$dir. '/' .$id. '/' .$param. '/' .$image;
		// }else{
		// 	return false;
		// }
	}


	/**
	 * Получаем изображение к записи в админке (string)
	 * $dir - название директории (string)
	 * $model - экземпляр класса модели (object)
	 * $param - название поля с изображением (string)
	 */
	public static function custom_get_image($dir, $model, $param){
		if($model->$param) {
			return '<div class="adminPanel_view-image-wrap"><img src="' .$model->$param. '" class="adminPanel_image"></div>';
			// return '<div class="adminPanel_view-image-wrap"><img src="/upload/custom/' .$dir. '/' .$model->id. '/' .$param. '/' .$model->$param. '" class="adminPanel_image"></div>';
		} else {
			return false;
		}
	}


	/**
	 * Транслитератор (string)
	 * $value - значение кириллицей (string)
	 */
	public static function transliterator($var){
		if($var){
			$var = mb_strtolower($var, 'UTF-8');
			$var = str_replace('.', "-", $var);
			$var = str_replace(',', "-", $var);
			$var = str_replace(' ', "-", $var);
			$var = str_replace('_', "-", $var);
			$var = str_replace('а', "a", $var);
			$var = str_replace('б', "b", $var);
			$var = str_replace('в', "v", $var);
			$var = str_replace('г', "g", $var);
			$var = str_replace('д', "d", $var);
			$var = str_replace('е', "e", $var);
			$var = str_replace('ё', "yo", $var);
			$var = str_replace('ж', "zh", $var);
			$var = str_replace('з', "z", $var);
			$var = str_replace('и', "i", $var);
			$var = str_replace('й', "y", $var);
			$var = str_replace('к', "k", $var);
			$var = str_replace('л', "l", $var);
			$var = str_replace('м', "m", $var);
			$var = str_replace('н', "n", $var);
			$var = str_replace('о', "o", $var);
			$var = str_replace('п', "p", $var);
			$var = str_replace('р', "r", $var);
			$var = str_replace('с', "s", $var);
			$var = str_replace('т', "t", $var);
			$var = str_replace('у', "u", $var);
			$var = str_replace('ф', "f", $var);
			$var = str_replace('х', "h", $var);
			$var = str_replace('ц', "ts", $var);
			$var = str_replace('ч', "ch", $var);
			$var = str_replace('ш', "sh", $var);
			$var = str_replace('щ', "sch", $var);
			$var = str_replace('ъ', "", $var);
			$var = str_replace('ы', "yi", $var);
			$var = str_replace('ь', "", $var);
			$var = str_replace('э', "e", $var);
			$var = str_replace('ю', "yu", $var);
			$var = str_replace('я', "ya", $var);
			$var = preg_replace('/-+/', '-', $var);
			$var = preg_replace('/[^a-z0-9-]/', '', $var);
			return $var;
		}
		return false;
	}



	/**
	 * Контроль уникальности алиаса (string)
	 * $value - значение, которое нужно уникализировать (string)
	 * $table - название таблицы БД (string)
	 * $field - название поля в таблице БД (string)
	 * $id - ID текущей записи (int | false)
	 */
	public static function alias_unique_control($value, $table, $field, $id = false){
		$value = static::transliterator($value);
		$table = '{{%'.$table.'}}';
		for ($i=1; $i < 1000000; $i++) { 
			$unique_control = (new \yii\db\Query())->select(['id'])->from($table)->where([$field => $value])->limit(1)->one();
			if($unique_control){
				preg_match_all('/-(\d+)\z/', $value, $value_index_arr);
				if(isset($value_index_arr[1][0])){
					$value_index = (int) $value_index_arr[1][0];
				}else{
					$value_index = 0;
				}			
				$value_index_new = $value_index + 1;
				if($value_index){
					$value = preg_replace('/-(\d+)\z/', "-{$value_index_new}", $value);
				}else{
					$value .= "-{$value_index_new}";
				}
				
			}else{
				break;
			}
		}
		return $value;
	}



	/**
	 * Удаление каталога с файлами
	 * $dir - название папки (string)
	 */
	public static function remDir($dir) {
	  if ($objs = glob($dir."/*")) {
	     foreach($objs as $obj) {
	       is_dir($obj) ? @static::remDir($obj) : @unlink($obj);
	     }
	  }
	  @rmdir($dir);
	}



	/**
	 * Получаем название класса для объекта (string)
	 * $model - экземпляр класса (object)
	 */
	public static function getClassName($model){
	    $class_name = strtolower( get_class($model) );
	    $class_name = explode('\\', $class_name);
	    $class_name = array_pop($class_name);
	    return $class_name;
	}



	/**
	 * Обвертка для изображения в админке (string)
	 * $model - экземпляр класса (object)
	 * $param - название поля с изображением (string)
	 */
	public static function getAdminCustomImage($model, $param, $redirect = null){
	    $class_name = static::getClassName($model);
	    $post_image = static::custom_get_image($class_name, $model, $param);
	    if($post_image){
	    	$res = '<div class="row">
			        <div class="col-sm-6">
			            <div class="adminPanel_image-wrap">'
			                .$post_image.
			            '</div>
			        </div>
			    </div>';
	    	/*
		    $res = '<div class="row">
			        <div class="col-sm-6">
			            <div class="adminPanel_image-wrap">'
			                .$post_image.
			                '<a href="' .Url::to(["/admin/{$class_name}/custom-remove-file", 'id' => $model->id, 'param' => $param, 'redirect' => $redirect]). '" class="del-link" title="Удалить изображение">x</a>
			            </div>
			        </div>
			    </div>';
			*/
			return $res;
		}else{
			return null;
		}
	}



	/**
	 * Получаем значение элемента массива по ключу (string)
	 * $arr - массив (array)
	 * $id - ключ (string)
	 */
	public static function customParamName($arr, $id){
		if(isset($arr[$id])){
			$res = $arr[$id];
		}else{
			$res = null;
		}
		return $res;
	}



	/**
	 * Формируем массив параметров $value с ключами в виде параметров $key
	 * $arr - исходный многомерный массив
	 * $key - параметр, который будет использоваться в качестве ключа в новом одномерном массиве
	 * $value - параметр, который необходимо собрать в новый одномерный массив
	 */
	public static function customParamArray($arr, $key, $value){
		if(!is_array($arr)) return false;
		$res = array();
		$arr_count = count($arr);		
		for ($i=0; $i < $arr_count; $i++) { 
			if($key == null){
				$res[$i] = $arr[$i][$value];
			}else{
				$res[$arr[$i][$key]] = $arr[$i][$value];
			}
		}
		return $res;
	}



	/**
	 * Формируем массив массивов параметров с ключами в виде параметров $key (array)
	 * $arr - исходный многомерный массив (array)
	 * $key - параметр, который будет использоваться в качестве ключа в новом массиве (string)
	 */
	public static function customMultiParamArray($arr, $key){
		if(!is_array($arr)) return false;
		$res = array();
		$arr_count = count($arr);		
		for ($i=0; $i < $arr_count; $i++) { 
			if($key == null){
				$res[$i] = $arr[$i];
			}else{
				$res[$arr[$i][$key]] = $arr[$i];
			}
		}
		return $res;
	}



	/**
	 * Формируем массив объектов с ключами в виде параметров $key (array)
	 * $arr - исходный массив объектов (array)
	 * $key - параметр, который будет использоваться в качестве ключа в новом массиве (string)
	 */
	public static function customMultiParamObject($arr, $key){
		if(!is_array($arr)) return false;
		$res = array();
		$arr_count = count($arr);		
		for ($i=0; $i < $arr_count; $i++) { 
			if($key == null){
				$res[$i] = $arr[$i];
			}else{
				$res[$arr[$i]->$key] = $arr[$i];
			}
		}
		return $res;
	}



	/**
	 * Добавляем пункт "Выбрать" в массив опций селекта (array)
	 * $arr - массив (array)
	 * $param - новый элемен массива (string)
	 * $sort - сотрировать массив по ключам (boolean)
	 */
	public static function custom_array_unshift($arr, $param, $sort = TRUE){
		if($sort){
			$arr[NULL] = $param;
			ksort($arr, SORT_NUMERIC);
			return $arr;
		}else{
			$new_arr[NULL] = $param;
			foreach ($arr as $key => $value) {
				$new_arr[$key] = $value;
			}
			return $new_arr;
		}
	}




	/**
	 * Переводим значенияе переменной 0 -> NULL
	 * $param - переменная для преобразования
	 */
	public static function custom_int_to_null($param){
		if($param === 0 || $param === '0'){
			$param = NULL;
		}
		return $param;
	}


	/**
	 * Переводим пустое значенияе переменной в NULL
	 * $param - переменная для преобразования
	 */
	public static function custom_empty_to_null($param){
		if(empty($param)){
			$param = NULL;
		}
		return $param;
	}


	/**
	 * Переводим значенияе переменной NULL -> 0
	 * $param - переменная для преобразования
	 */
	public static function custom_null_to_int($param){
		if($param === NULL){
			$param = 0;
		}
		return $param;
	}



	/**
	 * Генератор паролей (string)
	 */
	public static function generation_pass(){
		$characters = array(
			'a',
			'b',
			'c',
			'd',
			'e',
			'f',
			'g',
			'h',
			'i',
			'j',
			'k',
			'l',
			'm',
			'n',
			'o',
			'p',
			'q',
			'r',
			's',
			't',
			'u',
			'v',
			'w',
			'x',
			'y',
			'z',
			'0',
			'1',
			'2',
			'3',
			'4',
			'5',
			'6',
			'7',
			'8',
			'9',
			'-',
		);
		$res = '';
		for ($i=0; $i < 8; $i++) { 
			$rand = mt_rand(0, 36);
			$upper = mt_rand(0, 1);
			$word = $characters[$rand];
			if($upper) $word = strtoupper($word);
			$res .= $word;
		}
		return $res;
	}



	/**
	 * Генератор API ключей (string)
	 * $id - ID пользователя (int)
	 */
	public static function generation_token($id){
		$api_key = $id . static::generation_pass(). static::generation_pass(). time();
		$api_key = password_hash($api_key, PASSWORD_BCRYPT);
		$api_key = substr($api_key, -32);
		return $api_key;
	}




	/**
	 * Контроль уникальности Токена API (string)
	 * $table - название таблицы БД (string)
	 * $field - название поля в таблице БД (string)
	 * $id - ID пользователя (int)
	 */
	public static function token_unique_generation($table, $field, $id){
		$table = '{{%'.$table.'}}';
		$value = static::generation_token($id);
		for ($i=1; $i < 1000000; $i++) { 
			$unique_control = (new \yii\db\Query())->select(['id'])->from($table)->where([$field => $value])->limit(1)->one();
			if($unique_control){
				$value = static::generation_token($id);			
			}else{
				break;
			}
		}
		return $value;
	}



	/**
	 * Получаем значение куки (string)
	 * $name - название куки (string)
	 */
	public static function custom_get_cookie($name){
		if(isset(Yii::$app->params['cookie_name'])){
			$name = Yii::$app->params['cookie_name'] . '_' . $name;
		}
		if(isset($_COOKIE[$name]) && !empty($_COOKIE[$name])){
			return $_COOKIE[$name];
		}else{
			return NULL;
		}
	}



	/**
	 * Записываем куки (boolean)
	 * $name - название куки (string)
	 * $value - значение куки (string | int | boolean | array)
	 * $time - время жизни куки в секундах (int)
	 */
	public static function custom_set_cookie($name, $value, $time){
		if(isset(Yii::$app->params['cookie_name'])){
			$name = Yii::$app->params['cookie_name'] . '_' . $name;
		}	
		$time = $time + time();
		setcookie($name, $value, $time, '/');
		return TRUE;
	}



	/**
	 * Удаляем куки (boolean)
	 * $name - название куки (string)
	 */
	public static function custom_unset_cookie($name){
		if(isset(Yii::$app->params['cookie_name'])){
			$name = Yii::$app->params['cookie_name'] . '_' . $name;
		}
		$value = '';
		$time = time() - 3600 * 24;
		setcookie($name, $value, $time, '/');
		return TRUE;
	}



	/**
	 * Получаем E-mail адреса для уведомлений (array)
	 * $alias - алиас настроек для хранения email адресов (string)
	 */
	public static function custom_get_emails($alias = 'email-technical'){
		// $alias = 'email-application';
		// $alias = 'email-technical';
		$toEmail = Setting::getSetting($alias);
		if($toEmail){
			$toEmail = explode(',', $toEmail);
			if(is_array($toEmail)){
				$res = array();
				foreach ($toEmail as $one) {
					$email = static::filter_email($one);
					if($email){
						$res[] = $email;
					}
				}
				$res_count = count($res);
				if($res_count > 0){
					return $res;
				}
			}
		}
		return false;
	}



	/**
	 * Получаем адрес папки с файлами загрузки
	 */
	public static function get_upload_dir(){
		return realpath(__DIR__.'/../upload');
	}



	/**
	 * Получаем адрес папки с файлами для экспорта
	 */
	public static function get_export_dir(){
		return realpath(__DIR__.'/../upload/export');
	}



	/**
	 * Получаем адрес папки с файлами блокировки
	 */
	public static function get_flock_dir(){
		return realpath(__DIR__.'/../upload/flock');
	}



	/**
	 * Получаем адрес папки с файлами для хранения куки
	 */
	public static function get_cookie_dir(){
		return realpath(__DIR__.'/../upload/cookie');
	}



	/**
	 * Получаем адрес файла для хранения куки для cURL запросов
	 */
	public static function get_cookie_file(){
		$dir = static::get_cookie_dir();
		return realpath($dir.'/cookie.txt');
	}



	/**
	 * Стартуем cURL
	 * $httpheader - HTTP заголовки (array)
	 * $useragent - Юзерагент (string)
	 */
	public static function custom_curl_start($httpheader = null, $useragent = null){

		if (empty($useragent)) {
			$useragent = 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0';
		}
		
		$cookiefile = static::get_cookie_file();            // адерс файла для хранения куки
		
		$ch = curl_init();                                  // открываем cURL сессию
		curl_setopt($ch, CURLOPT_HEADER, 0);                // не сохранять заголовки
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent);   // браузер "пользователя"
		// curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.0.3; ko-kr; LG-L160L Build/IML74K) AppleWebkit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30');   // браузер "пользователя"

		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);     // следование любому заголовку "Location: ", отправленному сервером в своем ответе (учтите, что это происходит рекурсивно, PHP будет следовать за всеми посылаемыми заголовками "Location: ", за исключением случая, когда установлена константа CURLOPT_MAXREDIRS)
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);        // автоматическая установка поля Referer: в запросах, перенаправленных заголовком Location:.

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     // сохраняем полученные данные
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);   // получаем куки от сервера

		// Отключить ошибку "SSL certificate problem, verify that the CA cert is OK"
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		// Отключить ошибку "SSL: certificate subject name 'hostname.ru' does not match target host name '123.123'"
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

		if($httpheader){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader); // передаем HTTP заголовки
		}

		if(file_exists($cookiefile)){
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);   // передаем куки при запросе
			clearstatcache(true, $cookiefile);
		}
		return $ch;
	}


	/**
	 * Выполняем запрос cURL для открытой сессии
	 * $ch - сессия cURL
	 * $url - URL адрес запроса
	 * $post - массив POST параметров
	 */
	public static function custom_curl_query($ch, $url, $post = null){
		curl_setopt($ch, CURLOPT_URL, $url);
		if($post){
			// передаем POST параметры
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		$response = curl_exec($ch);                           // получаем данные от сервера

		/** --- Записываем логи ответов --- */
		if (!empty(Yii::$app->params['custom_params']['set_log_filename'])) {
			$set_log_data_arr = array();
			if (!empty(Yii::$app->params['custom_params']['set_log_data'])) {
				$set_log_data_arr[] = Yii::$app->params['custom_params']['set_log_data'];
			}
			$set_log_data_arr[] = date('d-m-Y H:i:s');
			$set_log_data_arr[] = $url;
			$set_log_data_arr[] = curl_getinfo($ch, CURLINFO_PRIMARY_IP) . ':' . curl_getinfo($ch, CURLINFO_PRIMARY_PORT);
			if (is_array($post) || is_object($post)) {
				$set_log_data_arr[] = json_encode($post, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			} else {
				$set_log_data_arr[] = $post;
			}
			$set_log_data_arr[] = $response;
			$set_log_data = "\r\n\r\n".implode("\r\n", $set_log_data_arr)."\r\n\r\n-----";
			file_put_contents(Yii::$app->params['custom_params']['set_log_filename'], $set_log_data, FILE_APPEND | LOCK_EX);
		}
		Yii::$app->params['custom_params']['set_log_filename'] = null;
		Yii::$app->params['custom_params']['set_log_data'] = null;
		/** end --- Записываем логи ответов --- end */

		$err = curl_error($ch);                               // получаем ошибки cURL
		if($err){
			return false;
		}
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);    // получаем статус ответа
		if($httpcode !== 200 && $httpcode !== 201){
			return false;
		}
		return $response;
	}


	/**
	 * Выполняем запрос cURL с открытием и закрытием сессии (string)
	 * $url - URL адрес запроса (string)
	 * $post - массив POST параметров
	 * $httpheader - HTTP заголовки (array)
	 * $useragent - Юзерагент (string)
	 */
	public static function custom_curl($url, $post = null, $httpheader = null, $useragent = null){
		$ch = static::custom_curl_start($httpheader, $useragent);         // стартуем  cURL
		$res = static::custom_curl_query($ch, $url, $post);   // получаем код страницы
		curl_close($ch);                              // закрываем  cURL
		return $res;
	}


	/**
	 * Выполняем запрос cURL через прокси сервер с открытием и закрытием сессии (string)
	 * $url - URL адрес запроса (string)
	 * $proxy_ip - прокси IP (string)
	 * $proxy_port - прокси порт (string)
	 * $proxy_login - прокси логин (string)
	 * $proxy_pass - прокси пароль (string)
	 * $post - массив POST параметров
	 * $httpheader - HTTP заголовки (array)
	 */
	public static function custom_proxy_curl($url, $proxy_ip, $proxy_port, $proxy_login, $proxy_pass, $post = null, $httpheader = null){
		$ch = static::custom_curl_start($httpheader);                 // стартуем  cURL
		if (!empty($proxy_ip) && !empty($proxy_port)) {
			$proxy = $proxy_ip .':'. $proxy_port;
			curl_setopt($ch, CURLOPT_PROXY, $proxy);                  // подключение к прокси-серверу
			if (!empty($proxy_login)) {
				$proxyauth = $proxy_login .':'. $proxy_pass;
				curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);   // если требуется авторизация
			}
		}
		$res = static::custom_curl_query($ch, $url, $post);           // получаем код страницы
		curl_close($ch);                                              // закрываем  cURL
		return $res;
	}



	/**
	 * Выполняем запрос cURL c базовой увторизацией basic http (string)
	 * $url - URL адрес запроса (string)
	 * $username - логин (string)
	 * $password - пароль порт (string)
	 * $post - массив POST параметров
	 * $httpheader - HTTP заголовки (array)
	 */
	public static function custom_basic_auth_curl($url, $username, $password, $post = null, $httpheader = null){
		$ch = static::custom_curl_start($httpheader);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);       
		curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);  
		$res = static::custom_curl_query($ch, $url, $post);   // получаем код страницы
		curl_close($ch);                                      // закрываем  cURL
		return $res;
	}



	/**
	 * Получаем новый URL адрес с GET параметрами текущего адреса (varchar)
	 * $new_url - новый URL адрес (varchar)
	 * $current_url - текущий URL адрес (varchar)
	 */
	public static function custom_current_url($new_url, $current_url){
		$new_url_arr = explode('?', $new_url);
		$current_url_arr = explode('?', $current_url);
		if(isset($new_url_arr[0]) && isset($current_url_arr[1])){
			$new_url = $new_url_arr[0] . '?' . $current_url_arr[1];
		}
		return $new_url;
	}




	/**
	 * Срабатывание цели - (записываем цель в сессию для дальнейшего вызова в футере сайта)
	 * $key - ID цели (string)
	 * $value - отправлять ценность цели (boolean)
	 */
	public static function metrika_goal($key, $value = true){
		if(!session_id()) session_start();
		if(!isset($_SESSION['metrika'])){
			$_SESSION['metrika'] = array();
		}
		if(!isset($_SESSION['metrika']['goal'])){
			$_SESSION['metrika']['goal'] = array();
		}
		$_SESSION['metrika']['goal'][$key] = $value;
		return true;
	}


	/**
	 * Быстрый вызов цели Маетрики и Аналитикс (string)
	 * $key - ID цели (string)
	 */
	public static function metrika_goal_quickly($key, $script = false){
		if (!empty($key)) {
			// Цели Маетрики и Аналитикс
			$goals = Yii::$app->params['goals'];
			if (!empty($goals) && !empty($goals[$key])) {
				$yandex_metrika = Setting::getSetting('yandex-metrika');
				$google_analytics = Setting::getSetting('google-analytics');
				if(!empty($yandex_metrika) || !empty($google_analytics)){
					$res = '';
					if(!empty($yandex_metrika)){
						$res .= 'yaCounter'.$yandex_metrika.'.reachGoal("'.$key.'");';
					}
					if(!empty($google_analytics)){
						$res .= 'gtag("event", "'.$goals[$key].'", {"event_category": "form", "event_action": "'.$key.'"});';
					}
					if (!empty($script)) {
						$res = '<script>' .$res. '</script>';
					}
					return $res;
				}
			}
		}
		return false;
	}


	/**
	 * Округляем число в большую сторону с заданной точностью (float)
	 * $number - число, которое нужно округлить (float)
	 * $significance - точность округления (int)
	 */
	public static function ceiling($number, $significance = 1){
    	$significance = pow(10, (int) $significance);
        return ( is_numeric($number) && is_numeric($significance) ) ? (ceil(round($number*$significance))/$significance) : false;
    }


	/**
	 * Проверяем права доступа пользователя
	 * $var - название парв пользователя (string|array)
	 */
	public static function custom_user_can($var){
		if(is_array($var)){
			$var_count = count($var);
			for ($i=0; $i < $var_count; $i++) { 
				$res = Yii::$app->user->can($var[$i]);
				if($res){
					return $res;
				}
			}
		}else{
			$res = Yii::$app->user->can($var);
		}
		return false;
	}



	/**
	 * Получаем значения по ключам (array)
	 * $arr_names - массив значений (array)
	 * $arr_keys - массив ключей (array)
	 */
	public static function custom_array_names($arr_names, $arr_keys, $link = null){
		if(!is_array($arr_keys) || !is_array($arr_names)) return null;
		$res = array();
		foreach ($arr_keys as $key) {
			if(isset($arr_names[$key])){
				if (!empty($link)) {
					$res[] = '<a href="'.$link.'?id='.$key.'" target="_blank">'.$arr_names[$key].'</a>';
				} else {
					$res[] = "<span>".$arr_names[$key]."</span>";
				}
			}
		}
		$res_count = count($res);
		if($res_count > 0){
			$res = implode(',<br>', $res);
			return $res;
		}else{
			return null;
		}
	}



	/**
	 * Получаем города для вывода в админке
	 * $arr_names - массив значений (array)
	 * $arr_keys - массив ключей (array)
	 */
	public static function custom_array_cities($arr_names, $arr_keys, $id = null){
		if (empty($id)) {
			$id = mt_rand(1000000, 9000000);
		}
		$rand = mt_rand(1000000, 9000000);
		$collapseId = 'citiesCollapse-' . $id . '-' . $rand;
		if(!is_array($arr_keys) || !is_array($arr_names)) return null;
		$res = array();
		foreach ($arr_keys as $key) {
			if(isset($arr_names[$key])){
				$res[] = "<span>".$arr_names[$key]."</span>";
			}
		}
		$res_count = count($res);
		if($res_count > 0){
			if ($res_count > 5) {
				$res1 = array_slice($res, 0, 5);
				$res2 = array_slice($res, 5);
				$res = '<div>' . implode(',<br>', $res1) . '</div><div class="collapse" id="'.$collapseId.'">' . implode(',<br>', $res2) . '</div>';
				$res = '<div class="cities-list-collapse">' . $res . '<a class="collapsed" role="button" data-toggle="collapse" href="#'.$collapseId.'" aria-expanded="false" aria-controls="'.$collapseId.'"><span class="collapse-link-open">показать еще...</span><span class="collapse-link-close">скрыть</span></a> </div>';
			} else {
				$res = implode(',<br>', $res);
			}
			return $res;
		}else{
			return null;
		}
	}



	/**
	 * Получаем города для вывода в админке
	 * $arr_names - массив значений (array)
	 * $arr_keys - массив ключей (array)
	 */
	public static function custom_array_partners($partners, $url, $id = null){
		if (empty($id)) {
			$id = mt_rand(1000000, 9000000);
		}
		$rand = mt_rand(1000000, 9000000);
		$collapseId = 'citiesCollapse-' . $id . '-' . $rand;
		$res = array();
		foreach ($partners as $key => $value) {
			if (!empty($key) && !empty($value)) {
				$res[] = "<a href='/admin/".$url."/view?id=".$key."'>".$value."</span>";
			}
		}
		$res_count = count($res);
		if($res_count > 0){
			if ($res_count > 5) {
				$res1 = array_slice($res, 0, 5);
				$res2 = array_slice($res, 5);
				$res = '<div>' . implode(',<br>', $res1) . '</div><div class="collapse" id="'.$collapseId.'">' . implode(',<br>', $res2) . '</div>';
				$res = '<div class="cities-list-collapse">' . $res . '<a class="collapsed" role="button" data-toggle="collapse" href="#'.$collapseId.'" aria-expanded="false" aria-controls="'.$collapseId.'"><span class="collapse-link-open">показать еще...</span><span class="collapse-link-close">скрыть</span></a> </div>';
			} else {
				$res = implode(',<br>', $res);
			}
			return $res;
		}else{
			return null;
		}
	}



	/**
	 * Получаем длинный текст для вывода в админке
	 */
	public static function custom_longtext_collapsed($text, $len=150){
		if (!empty($text)) {
			$text_len = mb_strlen($text);
			if ($text_len > $len) {
				$id = mt_rand(1000000, 9000000);
				$rand = mt_rand(1000000, 9000000);
				$collapseId = 'longtextCollapse-' . $id . '-' . $rand;
				$text1 = mb_substr($text, 0, $len);
				$text2 = mb_substr($text, $len);
				$text1 = static::custom_br($text1);
				$text2 = static::custom_br($text2);

				$res = '<div class="inline">' . $text1 . '</div><div class="collapse" id="'.$collapseId.'">' . $text2 . '</div>';
				$res = '<div class="longtext-list-collapse">' . $res . '<a class="collapsed" role="button" data-toggle="collapse" href="#'.$collapseId.'" aria-expanded="false" aria-controls="'.$collapseId.'"><span class="collapse-link-open">показать еще...</span><span class="collapse-link-close">скрыть</span></a> </div>';
				return $res;
			} else {
				$text = static::custom_br($text);
				return $text;
			}
		}
		return null;
	}



	/**
	 * Получаем скрипты и метатеги для страницы
	 * $disposition - расположение (int)
	 */
	public static function custom_get_page_script($disposition){
		if(isset(Yii::$app->params['tag'][$disposition]) && is_array(Yii::$app->params['tag'][$disposition])){
			return implode("\r\n", Yii::$app->params['tag'][$disposition]);
		}
		return false;
	}


	/**
	 * Задержка в работе скрипта
	 * $s - время задержки в секундах (float)
	 */
	public static function msleep($s){
	    usleep($s * 1000000);
	}


	/**
	 * Проверяем является ли посетитель Яндекс.Ботом (boolean)
	 * $ip - проверяемый IP адрес (string)
	 */
	public static function is_yandexbot($ip = null){
		if (empty($ip)) {
			$ip = Yii::$app->request->userIP;   // IP пользователя
		}
		$host_name = gethostbyaddr($ip);
		$is_yandex = preg_match('/yandex\.(ru|net|com)\z/i', $host_name);
		if ($is_yandex === 1) {
			$host_ip = gethostbyname($host_name);
			if ($host_ip === $ip) {
				return true;
			}
		}
		return false;
	}



	/**
	 * Получаем URL на основании адреса текущей страницы (string)
	 * $route - новый маршрут (string)
	 * $param - параметры, которые нужно заменить (array)
	 */
	public static function new_current_url($route = null, $param = null){
		if (empty($param)) {
			$param = array();
		}
		$url = Url::current($param);
		if (!empty($route)) {
			$new_url = Url::to($route);
			$url = explode('?', $url);
			if (!empty($url[1])) {
				$url = $new_url . '?' . $url[1];
			}
		}
		return $url;
	}




	/**
	 * Получаем котировки валют
	 */
	public static function ger_cbr_currency_rates(){
		$cbr_url = 'http://www.cbr.ru/scripts/XML_daily.asp';  // XML файл с котировками ЦБ РФ
		$res = array();
		// получаем объект с котировками
		$cbr_rate = @simplexml_load_file($cbr_url);
		// если массив получен
		if($cbr_rate){	
			$cbr_count = count($cbr_rate); // кол-во валют
			if($cbr_count > 0){
				$res['RUB'] = 1;
				// заполняем массив с котировками
				for ($i=0; $i<$cbr_count; $i++) { 
					$cbr_valute = $cbr_rate->Valute[$i];
					$cbr_CharCode = (string) $cbr_valute->CharCode;
					$cbr_Nominal = (float) $cbr_valute->Nominal;
					$cbr_Value = (float) str_replace(',', '.', $cbr_valute->Value);
					$res[$cbr_CharCode] = (float) ($cbr_Value / $cbr_Nominal);
				}
				return $res;
			}
		}
		return false;
	}


	/**
	 * Получаем котировку валюты
	 * $currency - алиас валюты (string)
	 */
	public static function ger_cbr_currency_rate($currency){
		if($currency){
			$currency = strtoupper($currency);
			if(!session_id()) session_start();
			if(isset($_SESSION['cbr_currency_rates'])){
				$rates = $_SESSION['cbr_currency_rates'];
			}else{
				$rates = static::ger_cbr_currency_rates();
				if($rates){
					$_SESSION['cbr_currency_rates'] = $rates;
				}
			}
			if(is_array($rates) && isset($rates[$currency])){
				return $rates[$currency];
			}
		}
		return false;
	}



	/**
	 * Получаем назкание города
	 */
	public static function get_SxGeoCity(){
		$SxGeoCity_filename = __DIR__ . DIRECTORY_SEPARATOR . 'SxGeo' . DIRECTORY_SEPARATOR . 'SxGeoCity.dat';
		if (file_exists($SxGeoCity_filename)) {
			$SxGeo = new \app\helpers\SxGeo\SxGeo($SxGeoCity_filename);
			$ip = Yii::$app->request->userIP;

			$res = $SxGeo->get($ip);
			if (!empty($res['city']) && !empty($res['city']['name_ru'])) {
				return $res['city']['name_ru'];
			}
		}
		return false;
	}



	/**
	 * Получаем название БД
	 */
	public static function getDatabaseName()
	{
		$dsn = Yii::$app->getDb()->dsn;
		if (preg_match('/dbname=([^;]*)/', $dsn, $match)) {
			return $match[1];
		} else {
			return null;
		}
	}

	/**
	 * Получаем имя таблицы БД
	 */
	public static function getTableName($tableName)
	{
		$tableName = ltrim($tableName, '{');
        $tableName = rtrim($tableName, '}');
        $tableName = ltrim($tableName, '%');
		$tablePrefix = Yii::$app->getDb()->tablePrefix;
		$tableName = $tablePrefix . $tableName;
		return $tableName;
	}

	/**
	 * Получаем автоинкремент таблицы БД
	 */
	public static function getAutoIncrement($tableName)
	{
		$tableName = static::getTableName($tableName);
		$DatabaseName = static::getDatabaseName();
		$id = Yii::$app->db->createCommand("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '{$DatabaseName}' AND TABLE_NAME = '{$tableName}'")->queryScalar();
		if (!empty($id)) {
			return $id;
		}
		return false;
	}


	/**
	 *	Выводим виджет ElFinder для загрузки файлов
	 */
	public static function ElFinderInputFile($form, $model, $name)
	{
		return $form->field($model, $name)->widget(\mihaildev\elfinder\InputFile::className(), [
            'language'      => 'ru',
            'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
            'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
            'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
            'options'       => ['class' => 'form-control'],
            'buttonOptions' => ['class' => 'btn btn-default'],
            'multiple'      => false       // возможность выбора нескольких файлов
        ]);
	}



	public static function truncateText($text, $maxLength) {
		// Проверяем, нужно ли обрезать текст
		if (mb_strlen($text) <= $maxLength) {
			return $text;
		}

		// Обрезаем текст до нужной длины
		$truncatedText = mb_substr($text, 0, $maxLength);

		// знаки препинания
		$punctuations = array(' ', '-', '.', ',', ':', ';', '!', '?');
		// обрезаем знаки препинания на конце строки
		$truncatedText = rtrim($truncatedText, implode('', $punctuations));

		// Проверяем, не обрезано ли последнее слово
		// Если последний символ обрезанного текста не является пробелом, убираем незаконченные слова
		$lastCharacter = mb_substr($text, $maxLength, 1);
		if (!empty($lastCharacter) && !in_array($lastCharacter, $punctuations)) {
			$truncatedText = mb_substr($truncatedText, 0, mb_strrpos($truncatedText, ' '));
		}

		// Добавляем троеточие, если текст был обрезан
		return $truncatedText . '...';
	}



}