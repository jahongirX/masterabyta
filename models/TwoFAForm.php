<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * TwoFAForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class TwoFAForm extends Model
{
    public $code;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['code'], 'validateCode'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'code' => 'Code',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateCode($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $date = time();
            if (empty($_SESSION['2FA']) || empty($_SESSION['2FA']['date']) || $_SESSION['2FA']['date'] < $date) {
                $message_error = 'Invalid authorization code';
                $this->addError($attribute, $message_error);
            }

            $code = $_SESSION['2FA']['code'];
            if (empty($code) || empty($this->code) || $code != $this->code) {
                $message_error = 'Invalid authorization code';
                $this->addError($attribute, $message_error);
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if (!empty($_SESSION['2FA'])) {
            $user = $this->getUser();
            if ($this->validate()) {
                $rememberMe = (boolean) $_SESSION['2FA']['rememberMe'];
                if($rememberMe){
                    $user->generateAuthKey();
                    $user->save();
                }
                unset($_SESSION['2FA']);
                return Yii::$app->user->login($user, $rememberMe ? 3600*24*30 : 0);
            }
            unset($_SESSION['2FA']);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            if (!empty($_SESSION['2FA']) && !empty($_SESSION['2FA']['user'])) {
                $this->_user = User::find()->where(['id' => $_SESSION['2FA']['user']])->limit(1)->one();
            }
        }

        return $this->_user;
    }
}
