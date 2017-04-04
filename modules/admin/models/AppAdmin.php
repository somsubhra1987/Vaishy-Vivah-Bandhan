<?php

namespace app\modules\admin\models;

use Yii;
use app\lib\core\App;
/**
 * This is the model class for table "app_admin".
 *
 * @property string $adminID
 * @property integer $adminGroupID
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $firstName
 * @property string $lastName
 * @property string $dateTimeCreated
 * @property string $address
 * @property string $countryCode
 * @property string $state
 * @property string $city
 * @property string $zip
 * @property string $phone
 * @property string $mobile
 * @property string $signature
 * @property integer $active
 */
class AppAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $adminGroupName;
    public $confirmpassword;
    
    public static function tableName()
    {
        return 'app_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['confirmpassword'], 'compare', 'compareAttribute' => 'password', 'on'=>'update'],
        	
            [['adminGroupID', 'username', 'email', 'firstName'], 'required'],
            [['adminGroupID', 'active'], 'integer'],
            [['dateTimeCreated','password','lastName', 'dateTimeCreated', 'address', 'countryCode', 'state', 'city', 'zip', 'phone', 'mobile', 'signature', 'active',], 'safe'],
            [['signature'], 'string'],
            [['username', 'firstName', 'lastName', 'state', 'city'], 'string', 'max' => 100],
            [['password'],'required', 'on'=>'insert'],
            [['password'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 150],
            [['address'], 'string', 'max' => 255],
            [['countryCode'], 'string', 'max' => 3],
            [['zip'], 'string', 'max' => 10],
            [['phone', 'mobile'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'adminID' => 'ID',
            'adminGroupID' => 'Admin ID',
            'adminGroupName' => 'Admin Group',
            'username' => 'Username',
            'password' => 'Password',
            'confirmpassword' => 'Confirm Password',
            'email' => 'Email',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'dateTimeCreated' => 'Date Time Created',
            'address' => 'Address',
            'countryCode' => 'Country Name',
            'state' => 'State',
            'city' => 'City',
            'zip' => 'Zip',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'signature' => 'Signature',
            'active' => 'Active',
        ];
    }

    public function beforeSave()
    {
        if($this->isNewRecord)
        {
            $this->password = App::getMd5($this->password);
        }
        return true;
    }
}
