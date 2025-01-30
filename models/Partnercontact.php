<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Partnercontact extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%partnercontact}}';
    }

}