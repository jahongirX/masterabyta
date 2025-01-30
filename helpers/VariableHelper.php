<?php

namespace app\helpers;

use Yii;
use app\models\Menu;
use app\models\Price;
use app\models\Setting;

class VariableHelper
{
	/**
	 * Получаем массив переменных
	 */
	public static function getVariablesArray()
	{
		if (!empty(Yii::$app->params['variables'])) {
			return Yii::$app->params['variables'];
		}
		
		$variable_arr = array();

		if (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['params']) && is_array(Yii::$app->params['city']['params'])) {
			foreach (Yii::$app->params['city']['params'] as $key => $value) {
				$variable_arr["param is={$key}"] = $value;
			}
		}

		if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['params']) && is_array(Yii::$app->params['partner']['params'])) {
			foreach (Yii::$app->params['partner']['params'] as $key => $value) {
				$variable_arr["param is={$key}"] = $value;
			}
		}

		$variable_arr['god'] = date('Y');

		$active_pages = Menu::getActivePages();
		if (!empty($active_pages) && is_array($active_pages)) {
			foreach ($active_pages as $key => $value) {
				if (!empty($key) && strpos($key, 'page=') === 0) {
					$one = trim($value, '/');
					if ($one) {
						$one = '/'.$one.'/';
					} else {
						$one = '/';
					}
					$variable_arr[$key] = $one;
				}
			}
		}

		Yii::$app->params['variables'] = $variable_arr;

		return Yii::$app->params['variables'];
	}


	/**
	 * Добавляем новую переменную (array|false)
	 * $key - ключ (string)
	 * $value - значение (string)
	 */
	public static function addNewVar($key, $value)
	{
		static::getVariablesArray();
		if (!empty(Yii::$app->params['variables'])) {
			Yii::$app->params['variables'][$key] = $value;
			return Yii::$app->params['variables'];
		}
		return false;
	}


	/**
	 * Получаем цену sprice
	 */
	public static function getSprice($page)
	{
		if (!empty($page)) {
			static::getVariablesArray();
			if (!empty(Yii::$app->params['variables'])) {
				if (isset(Yii::$app->params['variables']['sprice'])) {
					return Yii::$app->params['variables']['sprice'];
				}
				if (!empty($page) && !empty($page['sh_pricerow'])) {
					$price_id = $page['sh_pricerow'];
					$price = Price::find()->where(['id' => $price_id])->andWhere(['visible' => 1])->asArray()->limit(1)->one();
					if (!empty($price)) {
						if (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['price_type'])) {
							if (Yii::$app->params['city']['price_type'] == 1) {
								if (isset($price['price_msk'])) {
									$sprice = round($price['price_msk']);
									Yii::$app->params['variables']['sprice'] = $sprice;
									return $sprice;
								}
							} elseif (Yii::$app->params['city']['price_type'] == 2) {
								if (isset($price['price_region'])) {
									$sprice = round($price['price_region']);
									Yii::$app->params['variables']['sprice'] = $sprice;
									return $sprice;
								}
							}
						}
					}
				}
			}
		}
		return false;
	}


	/**
	 * Получаем значение переменной (string|false)
	 * $name - ключ (string)
	 */
	public static function getValue($name)
	{
		$var = static::getVariablesArray();
		if (!empty($var) && isset($var[$name])) {
			return $var[$name];
		}
		return false;
	}


	/**
	 * Получаем значение переменной параметра города (string|false)
	 * $name - ключ (string)
	 */
	public static function getParamValue($key)
	{
		$var = static::getVariablesArray();
		if (!empty($var) && isset($var["param is={$key}"])) {
			return $var["param is={$key}"];
		}
		return false;
	}


	/**
	 * Подстановка переменных (string)
	 * $string - переменная (string)
	 */
	public static function variableSubstitution($string)
	{
		$var = static::getVariablesArray();
		if (!empty($var) && is_array($var)) {
			foreach ($var as $key => $value) {
				if ($key === "param is=tel1" || $key === "param is=tel2") {
					$value = '<a href="tel:'.CustomHelper::phone_link($value).'">'.$value.'</a>';
				}
				$string = str_replace("[{$key}]", $value, $string);
			}
		}
		$string = preg_replace("@<a\s+[^>]?href=\"\[page=\d+\]\">(.*)<\/a>@U", '$1', $string);
		return $string;
	}



}