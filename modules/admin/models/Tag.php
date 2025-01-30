<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property int $id
 * @property string $name
 * @property int $disposition
 * @property string|null $text
 * @property string|null $city
 * @property int|null $number
 * @property int $visible
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'disposition'], 'required'],
            [['disposition', 'number', 'visible'], 'integer', 'min' => 0],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['city'], 'safe'],
            [['number'], 'default', 'value' => 0],
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
            'disposition' => 'Disposition',
            'text' => 'Text',
            'city' => 'City',
            'number' => 'Sort',
            'visible' => 'Visible',
        ];
    }
}
