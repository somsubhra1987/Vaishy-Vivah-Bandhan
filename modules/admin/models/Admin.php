<?php

namespace app\modules\admin\models;

use app\lib\Core;

class Admin extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $adminID;
    public $username;
    public $adminGroupID;
    public $isAdmin;


    /**
     * @inheritdoc
     */
    public static function findIdentity($adminID)
    {
	    $sql = "SELECT adminID, username, adminGroupID, 1 AS isAdmin
	    		FROM app_admin
	    		WHERE adminID = :adminID ";
	   	$admin = Core::getRow($sql, array('adminID'=>$adminID));
	    
        return empty($admin) ? null : new static($admin);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds admin by Credentials
     *
     * @param  string      $username
     * @param  string      $password
     * @return static|null
     */
    public static function findByCredentials($username, $password)
    {
        $sql = "SELECT adminID, username, adminGroupID, 1 AS isAdmin
	    		FROM app_admin
	    		WHERE active = 1
	    			AND username = :username
	    			AND password = MD5(:password) ";
	   	$admin = Core::getRow($sql, array('username'=>$username, 'password'=>$password));

        return empty($admin) ? null : new static($admin);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->adminID;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates credentials
     *
     * @param  string  $username
     * @param  string  $password
     * @return boolean if password provided is valid for current admin
     */
    public function validateCredentials($username, $password)
    {
	    $sql = "SELECT adminID
	    		FROM app_admin
	    		WHERE active = 1
	    			AND username = :username
	    			AND password = MD5(:password) ";
	   	$adminID = Core::getData($sql, array('username'=>$username, 'password'=>$password)); 
	   	
	   	if($adminID) return true;

	   	return false;
    }
}