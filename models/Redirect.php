<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Redirect extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%redirect}}';
    }

    /**
     * Выполняем 301 редирект
     */
    public static function go301Redirect()
    {
    	$urls = array();

    	$http = (!empty($_SERVER['HTTPS'])) ? 'https' : 'http';

    	$url1 = $_SERVER['REQUEST_URI'];
    	$url2 = preg_replace('/\?.*/', '', $url1);
        $url3 = rtrim($url2, '/');
        $url4 = trim($url2, '/');
        $url5 = $url4 . '/';
        $url6 = '/' .$url4;
    	$url7 = '/' .$url4 . '/';

    	$urls[] = $url1;
    	$urls[] = $url2;
        $urls[] = $url3;
        $urls[] = $url4;
        $urls[] = $url5;
        $urls[] = $url6;
    	$urls[] = $url7;

    	$urls[] = $_SERVER['HTTP_HOST'] . $url1;
    	$urls[] = $_SERVER['HTTP_HOST'] . $url2;
    	$urls[] = $_SERVER['HTTP_HOST'] . $url3;

    	$urls[] = $http.'://'.$_SERVER['HTTP_HOST'] . $url1;
    	$urls[] = $http.'://'.$_SERVER['HTTP_HOST'] . $url2;
    	$urls[] = $http.'://'.$_SERVER['HTTP_HOST'] . $url3;

    	$to = static::find()->select(['to_url'])->where(['from_url' => $urls])->andWhere(['visible' => 1])->orderBy(['id' => SORT_DESC])->limit(1)->scalar();

    	if (!empty($to)) {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: {$to}");
            exit();
        }

        return false;
    }

}