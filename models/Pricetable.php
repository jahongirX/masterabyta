<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Pricetable extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pricetable}}';
    }

}