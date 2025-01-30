<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%pricetable}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $price
 * @property int $visible
 */
class Pricetable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pricetable}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['visible'], 'integer'],
            [['price'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'price' => 'Price',
            'visible' => 'Visible',
        ];
    }
}
