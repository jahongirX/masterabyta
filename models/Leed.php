<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leed".
 *
 * @property int $id
 * @property string $name
 * @property string $message
 * @property string $phone
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $visible
 */
class Leed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'leed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'message', 'phone'], 'required'],
            [['message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['visible'], 'integer'],
            [['name', 'phone'], 'string', 'max' => 255],
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
            'message' => 'Message',
            'phone' => 'Phone',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'visible' => 'Visible',
        ];
    }
}
