<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $email
 * @property int $role
 * @property string $password
 * @property string|null $auth_key
 * @property int|null $ban
 * @property int|null $date_reg
 */
class User extends \yii\db\ActiveRecord
{
    public $new_password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'role', 'password'], 'required'],
            [['role', 'ban'], 'integer'],
            [['email', 'password', 'auth_key'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['auth_key'], 'unique'],
            [['date_reg'], 'trim'],
            [['ban'], 'default', 'value' => 0],
            [['date_reg'], 'default', 'value' => null],
            [['new_password'], 'string', 'min' => 6, 'max' => 255],
            [['new_password'], 'match', 'pattern' => '/^[a-z0-9\-\@\#\$\^\&\№\%\_]+$/i', 'message' => 'Только буквы (a-zA-Z), цифры (0-9) и символы (-@#$^&№%_)'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'role' => 'Role',
            'password' => 'Password',
            'new_password' => 'New password',
            'auth_key' => 'Auth Key',
            'ban' => 'Ban',
            'date_reg' => 'Date',
        ];
    }
}
