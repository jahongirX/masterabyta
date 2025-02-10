<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%review}}".
 *
 * @property int $id
 * @property string $header
 * @property string $name
 * @property int|null $master
 * @property string|null $service
 * @property int|null $rating
 * @property string|null $text
 * @property int|null $date
 * @property int $visible
 * @property string $user_image
 * @property string $image
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%review}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['header', 'name'], 'required'],
            [['master', 'rating', 'date', 'visible'], 'default', 'value' => null],
            [['master', 'rating', 'visible'], 'integer'],
            [['date'], 'trim'],
            [['text', 'service','user_image' , 'image'], 'string'],
            [['header', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header' => 'Header',
            'name' => 'Name',
            'master' => 'Master',
            'service' => 'Service',
            'rating' => 'Rating',
            'text' => 'Text',
            'date' => 'Date',
            'visible' => 'Visible',
            'user_image' => 'User Image',
            'image' => 'Image',
        ];
    }
}
