<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Master extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%master}}';
    }

    public function getPage()
    {
        return $this->hasOne(Page::class, ['id' => 'page']);
    }

}