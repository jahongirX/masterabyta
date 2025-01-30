<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Request extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%request}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['city', 'page', 'partner', 'rukiizplech_code', 'servicelead_code', 'leadcentre_code', 'date'], 'integer'],
            [['phone'], 'string', 'max' => 255],
            [['phone', 'city', 'page', 'partner', 'rukiizplech_code', 'servicelead_code', 'leadcentre_code'], 'default', 'value' => null],
        ];
    }

    /**
     * Записываем заявку в БД
     */
    public static function add($phone, $city, $page, $partner, $rukiizplech_code, $servicelead_code, $leadcentre_code)
    {
    	$model = new Request();
    	$model->phone = (!empty($phone)) ? (string) $phone : null;
    	$model->city = (!empty($city) || $city === 0 || $city === '0') ? (int) $city : null;
    	$model->page = (!empty($page) || $page === 0 || $page === '0') ? (int) $page : null;
    	$model->partner = (!empty($partner) || $partner === 0 || $partner === '0') ? (int) $partner : null;
    	$model->rukiizplech_code = (!empty($rukiizplech_code) || $rukiizplech_code === 0 || $rukiizplech_code === '0') ? (int) $rukiizplech_code : null;
        $model->servicelead_code = (!empty($servicelead_code) || $servicelead_code === 0 || $servicelead_code === '0') ? (int) $servicelead_code : null;
    	$model->leadcentre_code = (!empty($leadcentre_code) || $leadcentre_code === 0 || $leadcentre_code === '0') ? (int) $leadcentre_code : null;
    	$model->date = time();
    	if ($model->validate() && $model->save()) {
    		return $model;
    	}
    	return false;
    }

}