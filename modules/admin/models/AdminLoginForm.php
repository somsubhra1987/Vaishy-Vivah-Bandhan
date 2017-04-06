<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use app\lib\Core;

/**
 * LoginForm is the model behind the login form.
 */
class AdminLoginForm extends Model
{
    public $username;
    public $password;

    private $_admin = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate())
        {
	        $admin = $this->getAdmin();
	        if($admin && $admin->validateCredentials($this->username, $this->password))
	        {
		        $login = Yii::$app->user->login($this->getAdmin());
		        if($login)
		        {
			        $identity = Yii::$app->user->getIdentity();
			        Yii::$app->session['loggedAdminID'] = $identity->adminID;
		        }
            	return $login;
        	}
        	else
        	{
	        	$this->addError('username', 'Incorrect username or password.');
        	}
        }
        return false;
    }

    /**
     * Finds user by [[username]] and [[password]]
     *
     * @return Admin|null
     */
    public function getAdmin()
    {
        if ($this->_admin === false)
        {
            $this->_admin = Admin::findByCredentials($this->username, $this->password);
        }

        return $this->_admin;
    }
}
