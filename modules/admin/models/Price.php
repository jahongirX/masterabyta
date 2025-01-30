<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%price}}".
 *
 * @property int $id
 * @property string $name
 * @property int|null $price_section
 * @property string|null $unit
 * @property float $price_msk
 * @property float $price_region
 * @property string|null $link
 * @property int $number
 * @property int $visible
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%price}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['price_section', 'number', 'visible'], 'integer'],
            [['price_msk', 'price_region'], 'number', 'min' => 0],
            [['price_msk', 'price_region'], 'default', 'value' => 0],
            [['number'], 'default', 'value' => 1],
            [['name', 'unit', 'link'], 'string', 'max' => 255],
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
            'price_section' => 'Price Section',
            'unit' => 'Unit',
            'price_msk' => 'Price Msk',
            'price_region' => 'Price Region',
            'link' => 'Link',
            'number' => 'Sort',
            'visible' => 'Visible',
        ];
    }
}
