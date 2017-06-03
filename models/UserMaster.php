<?php

namespace app\models;
use Yii;
use yii\web\UploadedFile;
use app\lib\GdClient;
use app\lib\Core;
use app\lib\VEmail;
/**
 * This is the model class for table "user_master".
 *
 * @property string $userID
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property integer $isActive
 */
class UserMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $fileName, $height2;
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
            [['firstName', 'email'], 'required'],
            [['phoneNo','address','city', 'dob'], 'required', 'on'=>'registration'],
            [['isActive'], 'integer'],
            [['firstName', 'lastName'], 'string', 'max' => 100],
            [['userPassword','phoneNo','address','country', 'state', 'city', 'dob', 'subject', 'gender', 'personalInfo', 'aboutFamily','partnerPreference','profileID', 'profileCreatedFor', 'bodyType', 'height','age', 'physicalStatus', 'religionID', 'gothramID', 'casteID', 'annualIncome'],'safe'],
            [['email'], 'string', 'max' => 155],
            [['isActive'], 'default', 'value'=>'1'],
            [['lastName'], 'default', 'value'=> ''],            
            [['fileName'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType'=>false],
            [['email'], 'unique'],
			[['annualIncome'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userID' => 'User ID',
            'profileID'=>'Profile ID',
            'firstName' => 'Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'isActive' => 'Is Active',
            'userPassword' => 'Password',
            'phoneNo' => 'Phone Number',
            'address' => 'Address',
            'dob' => 'Date of birth',
			'religionID' => 'Religion',
			'gothramID' => 'Gothram',
			'casteID' => 'Caste',
			'annualIncome' => 'Annual Income (In Lakh)',
        ];
    }
    
    public function beforeSave()
    {
        if($this->isNewRecord){
            $this->profileID = Core::generateProfileID();
            $this->userPassword = rand(10000, 99999);
            $this->createDate = date('Y-m-d'); 
        }
        return true;
    }

    public function afterSave()
    {
        self::uploadImage();
        VEmail::sendNewRegisterMail($this);
    }

    function uploadImage()
    {
        $db = Yii::$app->db;
        $path = Core::getUploadedPath(); 
        if($this->fileName)
        {
            $mkpath = $path.'/user_master';
            @mkdir($mkpath, 0777, true);

            $mkpath = $path.'/upload_images';
            @mkdir($mkpath, 0777, true);   

            /*$sql = "SELECT fileName FROM user_uploaded_images WHERE refID = :refID AND refTable = :refTable ";
            $fileName = Core::getData($sql, array(':refID'=>$this->userID, ':refTable'=>'user_master'));

            if($fileName){
                $fileSaveDataPath = $path.'/user_master/' . $fileName;
                self::removeFile($fileSaveDataPath);
                
                $fileSaveData = $path.'/upload_images/' . $fileName;
                self::removeFile($fileSaveData);

                $fileSaveData = $path.'/upload_images/thumb/thumb_' . $fileName;
                self::removeFile($fileSaveData);

                $sql = "DELETE FROM user_uploaded_images WHERE refID = :refID AND refTable = :refTable";
                $cmd = $db->createCommand($sql);
                $cmd->bindValue(':refID', $this->userID);
                $cmd->bindValue(':refTable', 'user_master');
                $cmd->execute();
            }*/

            $fileName = $this->userID.'_profile_'.$this->fileName; 
            
            $fileSaveDataPath = $path.'/user_master/' . $fileName;
            self::removeFile($fileSaveDataPath);
            $this->fileName->saveAs($fileSaveDataPath);
                    
            $fileSaveData = $path.'/upload_images/' . $fileName;
            self::removeFile($fileSaveData);

            $this->fileName->saveAs($fileSaveData);
            $sql = "INSERT INTO user_uploaded_images set 
                            fileName = :fileName,
                            refID = :refID,
                            refTable = :refTable,
                            adminVerifiedStatus = :adminVerifiedStatus
                    ";
            $cmd = $db->createCommand($sql);
            $cmd->bindValue(':fileName', $fileName);
            $cmd->bindValue(':refID', $this->userID);
            $cmd->bindValue(':refTable', 'user_master');
            $cmd->bindValue(':adminVerifiedStatus','0');
            $cmd->execute();

            /*Create thumb image*/
            $sizeArr = getimagesize($fileSaveDataPath);
        
            $mainImageWidth = $sizeArr[0];
            $mainImageHeight = $sizeArr[1];
            //print_r($sizeArr); die();
            $mainWidth = 240;
            //die($path);
            $GdClient = new GdClient();
            $GdClient->saveResizedImage($fileSaveDataPath, $fileName,'user_master','thumb',$mainWidth,'',$mainImageWidth,$mainImageHeight);
        }
    }

    function removeFile($filePath)
    {
        if(file_exists($filePath))
        {
            @unlink($filePath);
        }
    }
}
