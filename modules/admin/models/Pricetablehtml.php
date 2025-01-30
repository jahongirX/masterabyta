<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%pricetablehtml}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $header
 * @property string|null $price
 * @property int $visible
 */
class Pricetablehtml extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pricetablehtml}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['price'], 'string'],
            [['visible'], 'integer'],
            [['name', 'header'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'header' => 'Header',
            'price' => 'Price',
            'visible' => 'Visible',
        ];
    }
}
