<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class PriceSection extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%price_section}}';
    }

}