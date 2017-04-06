<?php

namespace app\modules\admin\models;

use Yii;
use app\lib\Core;

/**
 * This is the model class for table "user_master".
 *
 * @property string $userID
 * @property string $profileID
 * @property string $firstName
 * @property string $lastName
 * @property string $gender
 * @property string $dob
 * @property string $email
 * @property string $userPassword
 * @property string $phoneNo
 * @property string $address
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $subject
 * @property string $personalInfo
 * @property string $aboutFamily
 * @property string $partnerPreference
 * @property string $profileCreatedFor
 * @property string $bodyType
 * @property string $height
 * @property string $age
 * @property string $physicalStatus
 * @property integer $isActive
 */
class UserMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'gender', 'dob', 'email', 'userPassword'], 'required'],
            [['dob', 'age', 'lastName', 'height', 'createDate'], 'safe'],
            [['address', 'personalInfo', 'aboutFamily', 'partnerPreference'], 'string'],
            [['height'], 'number'],
            [['isActive'], 'integer'],
            [['isActive', 'height', 'age'], 'default', 'value'=>0],
            [['profileID', 'gender', 'profileCreatedFor'], 'string', 'max' => 20],
            [['firstName', 'lastName', 'city'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 155],
            [['userPassword', 'subject'], 'string', 'max' => 255],
            [['phoneNo'], 'string', 'max' => 15],
            [['country', 'state', 'physicalStatus'], 'string', 'max' => 50],
            [['bodyType'], 'string', 'max' => 30],
            [['email'], 'unique'],
            [['profileID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userID' => 'User ID',
            'profileID' => 'Profile ID',
            'firstName' => 'Name',
            'lastName' => 'Last Name',
            'gender' => 'Gender',
            'dob' => 'Dob',
            'email' => 'Email',
            'userPassword' => 'Password',
            'phoneNo' => 'Phone No',
            'address' => 'Address',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'subject' => 'Subject',
            'personalInfo' => 'Personal Info',
            'aboutFamily' => 'About Family',
            'partnerPreference' => 'Partner Preference',
            'profileCreatedFor' => 'Profile Created For',
            'bodyType' => 'Body Type',
            'height' => 'Height',
            'age' => 'Age',
            'physicalStatus' => 'Physical Status',
            'isActive' => 'Is Active',
        ];
    }

    public function beforeSave(){
        if($this->isNewRecord){
            $this->isActive = 1;
            $this->createDate = date('Y-m-d');
        }
        if(!$this->profileID){
            $this->profileID = Core::generateProfileID();
        }
        return true;
    }
}
