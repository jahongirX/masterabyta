<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        /*
        if ($this->validate()) {
            if($this->rememberMe){
                $u = $this->getUser();
                $u->generateAuthKey();
                $u->save();
            }
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        */
        if (empty($_SESSION['2FA'])) {
            if ($this->validate()) {
                $code = $this->generate2FACode();
                if (!empty($code)) {
                    $code = (string) $code;
                    if (strlen($code) == 6) {
                        $user = $this->getUser();
                        if (!empty($user)) {
                            $date = time() + 60 * 30;
                            $_SESSION['2FA'] = array(
                                'user' => $user->id,
                                'code' => $code,
                                'date' => $date,
                                'rememberMe' => (boolean) $this->rememberMe
                                );
                            if (!empty($_SESSION['2FA']) && !empty($_SESSION['2FA']['code'])) {
                                $send = Yii::$app->mailer->compose('2fa', ['code' => $_SESSION['2FA']['code']])->setTo($user->email)->setSubject('Authorization code')->send();
                                return true;
                            }
                        }
                    }
                }
            }
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
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * Генерируем код для двухфакторной авторизации
     */
    public function generate2FACode()
    {
        $code = '';
        $arr = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        shuffle($arr);
        for ($i=0; $i < 6; $i++) { 
            $n = mt_rand(0, 9);
            if (isset($arr[$n])) {
                $code .= $arr[$n];
            }
        }
        return $code;
    }

}
