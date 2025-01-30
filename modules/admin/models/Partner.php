<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%partner}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $params
 * @property string|null $phone
 * @property string|null $front_email
 * @property string $back_email
 * @property string $mail_subject
 * @property string|null $wokrtime
 * @property string|null $tag_header
 * @property string|null $tag_body
 * @property string $city
 * @property string $page
 * @property int $visible
 */
class Partner extends \yii\db\ActiveRecord
{
    public $token = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%partner}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'back_email'], 'required'],
            [['params', 'tag_header', 'tag_body'], 'string'],
            [['visible'], 'integer'],
            [['name', 'phone', 'front_email', 'back_email', 'mail_subject', 'wokrtime'], 'string', 'max' => 255],
            [['front_email', 'back_email'], 'email'],
            [['city', 'page'], 'safe'],
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
            'params' => 'Params',
            'phone' => 'Phone',
            'front_email' => 'Front Email',
            'back_email' => 'Back Email',
            'mail_subject' => 'Mail Subject',
            'wokrtime' => 'Wokrtime',
            'tag_header' => 'Tag Header',
            'tag_body' => 'Tag Body',
            'city' => 'City',
            'page' => 'Page',
            'visible' => 'Visible',
        ];
    }
}
