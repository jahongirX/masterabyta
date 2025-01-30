<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Review extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%review}}';
    }

    public static function stars($num)
    {
	    if($num=="NAN"){
	        $num=4;
	    }
	    $ret='<div class="stars">';
	    for($i=0;$i<(int)$num;$i++){
	        $ret.='<i class="fa fa-star"></i>';
	    }
	    $ret.='</div>';
	    return $ret;
	}

	public static function getMasterName($masterId)
	{
		if (!empty($masterId)) {
			return Master::find()->select(['name'])->where(['id' => $masterId])->limit(1)->scalar();
		}
		return false;
	}

	/**
     * Получаем массив ссылок на услуги
     */
    public static function getServiceArray($id)
    {
        $data = static::find()->select(['service'])->where(['id' => $id])->andWhere(['visible' => 1])->limit(1)->scalar();
        return Menu::controlMenuArray($data);
    }

	/**
     * Формируем html разметку для ссылок на услуги (string)
     */
    public static function formatMenuHtml($menu)
    {
    	return Menu::formatMenuHtml($menu, $class = 'user-review-service-menu', $max_count = null);
    }


}