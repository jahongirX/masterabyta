<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Blocktechnical extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blocktechnical}}';
    }

    /**
     * Получаем массив технических блоков
     */
    public static function getBlocksArray()
    {
    	$blocktechnical = static::find()->where(['visible' => 1])->orderBy(['id' => SORT_ASC])->asArray()->all();
    	$blocktechnical = CustomHelper::customMultiParamArray($blocktechnical, 'id');
    	return $blocktechnical;
    }

    /**
     * Получаем номер телефона для вывода в шапке, футере, и т.д.
     */
    public static function getPhone()
    {
        // проверяем, главный ли это город
        $isMainCity = City::isMainCity();
        // получаем id родительской страницы
        $page_parent = (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['parent'])) ? Yii::$app->params['page']['parent'] : null;

        if ($isMainCity) {
            $headerPhone = "+7 (499) 286-91-72";
        } else {
            switch ($page_parent) {
                case '9793': // родительская ремонт бытовой техники
                    $headerPhone = "+7 (981) 077-99-03";
                    break;
                case '9565': // родительская Акции и цены
                    $headerPhone = "+7 (981) 077-99-03";
                    break;
                default:
                    $headerPhone = "+7 (981) 077-97-03";
            }
        }

        if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['phone'])) {
            $headerPhone = Yii::$app->params['partner']['phone'];
        }

        if (!empty($headerPhone)) {
            return $headerPhone;
        }
        return false;
    }

}