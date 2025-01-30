<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Setting;
use app\helpers\CustomHelper;
use app\helpers\UrlHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class City extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * Получаем текущий домен
     */
    public static function getDomain(){
        $url = Url::to(['/'], true);
        $domain = preg_replace('/(https?:)?\/\//', '', $url);
        $domain = explode('/', $domain, 2);
        return $domain[0];
    }

    /**
     * Получаем текущий город
     */
    public static function getDomainCity(){
        $domain = static::getDomain();
        $domain = explode('.', $domain);
        $domain_count = count($domain);


        $domain_level = Yii::$app->params['domain-level'];
        if ($domain_count > $domain_level) {
            $city_alias = $domain[0];
        }

        $city_default = Setting::getSetting('city-default');

        if (!empty($city_alias)) {
            $city = City::find()->where(['alias' => $city_alias])->andWhere(['visible' => 1])->asArray()->limit(1)->one();
            if (empty($city)) {
                $url = preg_replace("/^{$city_alias}\./", '', $_SERVER['HTTP_HOST']);
                $url = 'https://' . $url . $_SERVER['REQUEST_URI'];
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: {$url}");
                exit();
            }
            if (!empty($city) && $city['id'] == $city_default) {
                $url = preg_replace("/^{$city_alias}\./", '', $_SERVER['HTTP_HOST']);
                $url = 'https://' . $url . $_SERVER['REQUEST_URI'];
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: {$url}");
                exit();
            }
        }

        if (empty($city)) {
            if (!empty($city_default)) {
                $city = City::find()->where(['id' => $city_default])->andWhere(['visible' => 1])->asArray()->limit(1)->one();
            }
        }
        if (empty($city)) {
            $city = City::find()->where(['visible' => 1])->orderBy(['id' => SORT_ASC])->asArray()->limit(1)->one();
        }

        // Парсим параметры города для переменных
        if (!empty($city)) {
            if (!empty($city['params']) && is_string($city['params'])) {
                $params = array();
                $city['params'] = trim($city['params']);
                $city['params'] = preg_replace("@[\r\n]+@", '\r\n', $city['params']);
                $city['params'] = explode('\r\n', $city['params']);
                $city['params'] = array_map('trim', $city['params']);
                if (!empty($city['params']) && is_array($city['params'])) {
                    foreach ($city['params'] as $one) {
                        $param = explode('=', $one, 2);
                        if (isset($param[0]) && isset($param[1])) {
                            $params[$param[0]] = $param[1];
                        }
                    }
                    $city['params'] = $params;
                }
            }
            if (!empty($city['district']) && is_string($city['district'])) {
                $city['district'] = trim($city['district']);
                $city['district'] = preg_replace("@[\r\n]+@", '\r\n', $city['district']);
                $city['district'] = explode('\r\n', $city['district']);
                $city['district'] = array_map('trim', $city['district']);
            }
            $city['street-url'] = array();
            if (!empty($city['street']) && is_string($city['street'])) {
                $city['street'] = trim($city['street']);
                $city['street'] = preg_replace("@[\r\n]+@", '\r\n', $city['street']);
                $city['street'] = preg_replace("@\s*\|\|\s*@", '||', $city['street']);
                $city['street'] = explode('\r\n', $city['street']);
                $city['street'] = array_map('trim', $city['street']);

                $streetArr = array();
                $streetUrlArr = array();
                foreach ($city['street'] as $one) {
                    $street = explode('||', $one);
                    $streetArr[] = $street[0];
                    $streetUrlArr[] = $street;
                }
                $city['street'] = $streetArr;
                $city['street-url'] = $streetUrlArr;
            }
            $city['metro-url'] = array();
            if (!empty($city['metro']) && is_string($city['metro'])) {
                $city['metro'] = trim($city['metro']);
                $city['metro'] = preg_replace("@[\r\n]+@", '\r\n', $city['metro']);
                $city['metro'] = preg_replace("@\s*\|\|\s*@", '||', $city['metro']);
                $city['metro'] = explode('\r\n', $city['metro']);
                $city['metro'] = array_map('trim', $city['metro']);

                $metroArr = array();
                $metroUrlArr = array();
                foreach ($city['metro'] as $one) {
                    $metro = explode('||', $one);
                    $metroArr[] = $metro[0];
                    $metroUrlArr[] = $metro;
                }
                $city['metro'] = $metroArr;
                $city['metro-url'] = $metroUrlArr;
            }
        }

        if (!empty($city['back_email']) && is_string($city['back_email'])) {
            $city['back_email'] = trim($city['back_email']);
            $city['back_email'] = trim($city['back_email'], ',');
            $city['back_email'] = trim($city['back_email']);
            $city['back_email'] = explode(',', $city['back_email']);
            $city['back_email'] = array_map('trim', $city['back_email']);
        }

        return $city;
    }


    /**
     * Получаем массив городов (array)
     */
    public static function getCitiesList()
    {
        return static::find()->select(['id', 'name', 'alias'])->where(['visible' => 1])->orderBy(['number' => SORT_ASC, 'name' => SORT_ASC])->asArray()->all();
    }

    /**
     * Проверяем главный ли это город
     */
    public static function isMainCity()
    {
        if (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['id'])) {
            $city_default = Setting::getSetting('city-default');
            if (!empty($city_default) && Yii::$app->params['city']['id'] == $city_default) {
                return true;
            }
        }
        return false;
    }


}