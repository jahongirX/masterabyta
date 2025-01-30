<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Setting extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * Получаем настройку
     * $alias - алиас настройки (string)
     * $value - новое значение (string)
     */
    public static function getSetting($alias, $type = 'value'){
        $type = ($type === 'name') ? 'name' : 'value';

        if (empty(Yii::$app->params['setting'])) {
            $setting = static::find()->asArray()->all();
            $setting = CustomHelper::customMultiParamArray($setting, 'alias');
            Yii::$app->params['setting'] = $setting;
        }
        if(isset(Yii::$app->params['setting'][$alias][$type])){
            return Yii::$app->params['setting'][$alias][$type];
        }else{
            return false;
        }
    }

    /**
     * Записываем настройку
     * $alias - алиас настройки (string)
     * $value - новое значение (string)
     */
    public static function setSetting($alias, $value){
        if($alias){
            $tableName = static::tableName();
            $res = Yii::$app->db->createCommand()->update($tableName, ['value' => $value], ['alias' => $alias])->execute();
            if ($res) {
                if (!empty(Yii::$app->params['setting'])) {
                    Yii::$app->params['setting'][$alias] = $value;
                }
                return true;
            }
        }
        return false;
    }

}