<?php

namespace app\models;
use Yii;
class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $isUser;
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $sql = "SELECT userID as id, firstName as username, 1 AS isUser
                FROM user_master
                WHERE userID = :id ";
        $db = Yii::$app->db;
        $cmd = $db->createCommand($sql);
        $cmd->bindValue('id', $id);
        $user = $cmd->queryOne();
        return empty($user) ? null : new static($user);        
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        return null;
    }

    public static function findByCredentials($username, $password)
    {  
        $db = Yii::$app->db;    
        //$password = ($password)? MD5($password):$password; 
        $sql = "SELECT userID as id, firstName as username, 1 AS isUser
                FROM user_master
                WHERE email = :username
                    AND userPassword = :password 
                    ";
        $cmd = $db->createCommand($sql);
        $cmd->bindValue(':username', $username);
        $cmd->bindValue(':password', $password);
        $user = $cmd->queryOne();        
        return empty($user) ? null : new static($user);
    }
     /**
     * Validates credentials
     *
     * @param  string  $username
     * @param  string  $password
     * @return boolean if password provided is valid for current user
     */
    public function validateCredentials($username, $password)
    {
        $db = Yii::$app->db;
        //$password = ($password)? MD5($password):$password;
        $sql = "SELECT userID as id
                FROM user_master
                WHERE 
                    email = :username
                    AND userPassword = :password ";
        $cmd = $db->createCommand($sql);
        $cmd->bindValue(':username', $username);
        $cmd->bindValue(':password',$password);        
        $id = $cmd->queryScalar();
        if($id) return true;
        return false;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
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
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
}