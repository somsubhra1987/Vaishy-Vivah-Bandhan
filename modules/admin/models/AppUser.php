<?php

namespace app\modules\admin\models;
use Yii;
use app\lib\core\App;
use app\lib\core\RpEmail;


/**
 * This is the model class for table "app_user".
 *
 * @property string $userID
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
 * @property integer $activated
 * @property integer $cancelled
 * @property integer $subscribed
 * @property string $signature
 * @property string $regUserIp
 * @property string $regUserAgent
 * @property string $authKey
 * @property string $authKeyCreatedOn
 * @property string $accessToken
 * @property string $accessTokenCreatedOn
 * @property string $lastLoggedInOn
 * @property string $lastLoggedInUserIp
 * @property string $lastLoggedInUserAgent
 */
class AppUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $userRoleIDs = array();
    public $confirmpassword;
    public $dateRegistered;
    public $generatePassword;
    
    public static function tableName()
    {
        return 'app_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['confirmpassword'], 'compare', 'compareAttribute' => 'password', 'on'=>'update'],
            [['username', 'email', 'firstName', 'lastName'], 'required'],
            [['password'],'required', 'on'=>'insert'],
            [['signature','dateTimeCreated', 'regUserIp', 'lastLoggedInUserIp', 'authKeyCreatedOn', 'accessTokenCreatedOn', 'lastLoggedInOn', 'confirmpassword'], 'safe'],
            [['username', 'activated', 'cancelled', 'subscribed'], 'integer'],           
            [['firstName', 'lastName', 'state', 'city', 'authKey', 'accessToken'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 150],
            [['address', 'address2', 'address3','regUserAgent', 'lastLoggedInUserAgent','paypalEmailID'], 'string', 'max' => 255],
            [['countryCode'], 'string', 'max' => 3],
            [['zip'], 'string', 'max' => 10],
            [['phone', 'mobile'], 'string', 'max' => 20],            
            [['username'], 'unique'], 
            [['email'], 'email'],           
            [['email'], 'unique'],
            [['password'],'required','on'=>'insert'],
            [['password'], 'compare', 'compareAttribute'=>'confirmpassword','on'=>'update'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userID' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'confirmpassword' => 'Confirm Password',
            'email' => 'Email',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'dateTimeCreated' => 'Date Time Created',
            'address' => 'Address',
            'countryCode' => 'Country Code',
            'state' => 'State',
            'city' => 'City',
            'zip' => 'Zip',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'activated' => 'Activated',
            'cancelled' => 'Cancelled',
            'subscribed' => 'Subscribed',
            'signature' => 'Signature',
            'userRoleIDs' => 'User Roles',
            'regUserIp' => 'Reg User Ip',
            'regUserAgent' => 'Reg User Agent',
            'authKey' => 'Auth Key',
            'authKeyCreatedOn' => 'Auth Key Created On',
            'accessToken' => 'Access Token',
            'accessTokenCreatedOn' => 'Access Token Created On',
            'lastLoggedInOn' => 'Last Logged In On',
            'lastLoggedInUserIp' => 'Last Logged In User Ip',
            'lastLoggedInUserAgent' => 'Last Logged In User Agent',
        ];
    }
    
    public function getUserUserRoles($userID)
	{
		$userID = (int)$userID;
		
		$db = Yii::$app->db;
		
		$sql = "SELECT R.userRoleID
				FROM app_user AS U
					INNER JOIN app_user_user_role AS R USING(userID)
				WHERE U.userID = '$userID'";
				
		$cmd=$db->createCommand($sql);
		$rows = $cmd->queryAll();
		
		$userRoleIDArr=array();
		foreach($rows as $key => $value)
		{
			$userRoleIDArr[] = $value['userRoleID'];
		}
		
		return $userRoleIDArr;
	}
    
    public function z_getCheckboxSelectedValue()
	{
		$db = Yii::$app->db;
		
		$sql = "SELECT R.userRoleID 
				FROM app_user AS U
					INNER JOIN app_user_user_role AS R USING(userID)
				WHERE U.userID = '$this->userID'";
				
		$cmd=$db->createCommand($sql);
		$rows = $cmd->queryAll();
		
		$userRoleIDArr=array();
		foreach($rows as $key => $value)
		{
			$userRoleIDArr[] = $value['userRoleID'];
		}
		
		return $userRoleIDArr;
	}

	public function beforeSave()
	{		
		$this->regUserAgent = Yii::$app->request->getUserAgent();
		$this->regUserIp = Yii::$app->request->getUserIP();
		$this->dateTimeCreated = date('Y-m-d H:i:s');
		if($this->password != '')
		{
			$this->generatePassword = $this->password;
			$this->password = App::getMd5($this->password);	
		}
		if(!$this->isNewRecord && $this->password == '')
		{
			$sql = "SELECT 
						password 
					FROM app_user 
					WHERE userID = :userID ";
			$this->password = App::getData($sql, array('userID'=>$this->userID));			
		}		
		return true;		
	}
	
	public function afterSave($insert, $changedAttributes)
	{
		if($insert)
		{
			if($this->email)
	    	{
		    	$userDetail = array();
		    	$userDetail['email'] = $this->email;
		    	$userDetail['username'] = $this->firstName;
		    	$userDetail['suiteno'] = $this->username; 
		    	$userDetail['password'] = $this->generatePassword; 
	    		RpEmail::sendNewRegistrationEmail($userDetail);
			}
		}
		else
		{

			if($this->generatePassword)
			{				
				RpEmail::sendNewResetPasswordEmail($this->email,$this->generatePassword);
			}
		}
		
		return true;
	}	

	public function getUserAutocompleteList($name)
	{
		$userArr = array();

		$sql = "SELECT 
					userID, CONCAT(username, '(', firstName, ' ', lastName, ')' ) as name
				FROM app_user 
				WHERE cancelled = '0'
				HAVING NAME LIKE '%$name%'
				ORDER BY username ASC";
		$userList = App::getRows($sql);
		foreach($userList as $key=>$data)
		{
			$arr = array();
			$arr['label'] = $data['name'];
			$arr['value'] = $data['name'];
			$arr['userID'] = $data['userID'];
			array_push($userArr, $arr);			
		}
		return $userArr;
	}

	public function getUserAssoc()
	{
		$sql = "SELECT 
					userID, CONCAT(username, '(', firstName, ' ', lastName, ')' ) as name
				FROM app_user 
				WHERE cancelled = '0'				
				ORDER BY username ASC";
		$userList = App::getDropdownAssoc($sql);
		return $userList;
	}

	public function getNotInMembershipAssoc()
	{
		$sql = "SELECT U.userID, CONCAT(username, '(', firstName, ' ', lastName, ')' ) as name
				FROM app_user U
				LEFT OUTER JOIN ukmb_membership M ON U.userID = M.userID
				WHERE M.userID IS NULL AND U.deletedFlag = 0";
		$userList = App::getDropdownAssoc($sql);
		return $userList;
	}

	public function updatePaypalEmail($paypalEmailID, $userID)
	{
		$db = Yii::$app->db;
		$sql = "UPDATE app_user SET 
					paypalEmailID = :paypalEmailID 
				WHERE userID = :userID ";
		$cmd = $db->createCommand($sql);
		$cmd->bindValues([':paypalEmailID'=>$paypalEmailID, ':userID'=>$userID]);
		$cmd->execute();
	}

	public function generateRandomCustcode()
	{
		$i=0;
		$db = Yii::$app->db;
		$max = 99999;
		while(!$this->username){			
			$custCode = mt_rand(10000, $max);
			if($i>20)
			{
				$i = 0;
				$max = $max.'9';
				$custCode = mt_rand(10000, $max);				
			}
			$sql = "SELECT 
						username 
					FROM app_user 
					WHERE username = :username ";
			$cmd = $db->createCommand($sql);	    		
	    	$cmd->bindValue(":username", $custCode);
	    	$row = $cmd->queryScalar();
	    	
	    	if(!$row)
	    	{
		    	return $custCode;
		    }
		    $i++;
		}
	}
}
