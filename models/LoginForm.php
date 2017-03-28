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
        ];
    }

     public function attributeLabels()
    {
        return [
            'username' => 'Email ID',
            'password' => 'Password',
            ];
    }
    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate())
        {
            $user = $this->getUser();
            if($user && $user->validateCredentials($this->username, $this->password))
            {
                $login = Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 1);                              
                return $login;
            }
            else
            {
                $this->addError('password', 'Incorrect username or password.');
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
            $this->_user = User::findByCredentials($this->username, $this->password);
        }       
        return $this->_user;
    }
}