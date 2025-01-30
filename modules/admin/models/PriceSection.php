<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%price_section}}".
 *
 * @property int $id
 * @property string $name
 * @property int $visible
 */
class PriceSection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%price_section}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['visible'], 'integer'],
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
            'visible' => 'Visible',
        ];
    }
}
