<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $repeat_password;
    public $accept_conditions;
    // public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'repeat_password', 'email'], 'required'],
            // email is a valid email
            ['email', 'email'],
            // rememberMe must be a boolean value
            ['accept_conditions', 'boolean'],
            // user must accept conditions
            ['accept_conditions', 'conditionsAccepted'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            // ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'username' => 'User Name',
            'password' => 'Password',
            'email' => 'Email',
            'repeat_password' => 'Repeat Password',
            'accept_conditions' => 'Accept Terms and Conditions',
            // 'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Validates the password.
     * This method password confirmation.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password !== $this->repeat_password) {
                $this->addError($attribute, "Password doesn't match.");
            }
        }
    }

    public function conditionsAccepted($attribute, $params)
    {
      if (!$this->hasErrors()){
        if (!$this->accept_conditions){
          $this->addError($attribute, "You must accept terms and conditions.");
        }
      }
    }

    /**
     * Signup a user using the provided data.
     * @return bool whether the user is signed up successfully
     */
    public function signup()
    {
        if ($this->validate() && $this->accept_conditions) {
          $user = new User();
          $user->username = $this->username;
          $user->email = $this->email;
          $user->setPassword($this->password);
          // $user->generateAuthKey(); // this is done in User->beforeSave() instead
          $user->generateAccessToken();
          $user->save(false);
          return $user;
        }
        return false;
    }

}
