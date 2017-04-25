<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\Query;
use yii\web\UploadedFile;
use app\lib\Core;
use app\lib\GdClient;

/**
 * This is the model class for table "app_testimonials".
 *
 * @property string $testimonialsID
 * @property string $groomName
 * @property string $groomShortDescription
 * @property string $brideName
 * @property string $brideShortDescription
 * @property string $coupleImage
 */
class Testimonials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_testimonials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groomName', 'groomShortDescription', 'brideName', 'brideShortDescription'], 'required'],
            [['groomShortDescription', 'brideShortDescription'], 'string'],
            [['groomName', 'brideName'], 'string', 'max' => 100],
			[['dateTimeCreated', 'testimonialsID'], 'safe'],
			[['coupleImage'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif','jpeg']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'testimonialsID' => 'Testimonials ID',
            'groomName' => 'Groom Name',
            'groomShortDescription' => 'Groom Short Description',
            'brideName' => 'Bride Name',
            'brideShortDescription' => 'Bride Short Description',
            'coupleImage' => 'Couple Image (Resolution : 242 X 307)',
        ];
    }
	
	public function beforeSave()
	{
		$this->dateTimeCreated = date('Y-m-d H:i:s');
		
		$this->coupleImage = UploadedFile::getInstance($this, 'coupleImage');
			
		if(!$this->coupleImage){ $this->coupleImage = '';}
		
		return true;
	}
	
	public function afterSave($insert, $changedAttributes)
	{
		$db = Yii::$app->db;
		$path = Core::getUploadedPath();		
		
		if($this->coupleImage) 
		{			
			$testimonialsImagePath = $path .'/testimonial_image';
			if(!is_dir($testimonialsImagePath)) {
			   mkdir($testimonialsImagePath);
			   chmod($testimonialsImagePath, 0777); 
			}
			
			$testimonialsImageMainPath = 	$testimonialsImagePath .'/main';
			
			if(!is_dir($testimonialsImageMainPath)) {
			   mkdir($testimonialsImageMainPath);
			   chmod($testimonialsImageMainPath, 0777); 
			}
			
			$sql = "SELECT coupleImage 
					FROM app_testimonials 
					WHERE testimonialsID = '$this->testimonialsID'";
			$cmd = $db->createCommand($sql);
			$oldTestimonialsImage = $cmd->queryScalar();
			
			$oldTestimonialsImagePath = $testimonialsImagePath .'/main/main_'.$oldTestimonialsImage;
			
			if(file_exists($oldTestimonialsImagePath)) {
				unlink($oldTestimonialsImagePath);
			}
			
			/*============== save original image ========================*/
			
			$testimonialsImage = $testimonialsImagePath .'/main/org_'.$this->testimonialsID.'_'.$this->coupleImage;
			
			$this->coupleImage->saveAs($testimonialsImage);
			
			/*===========================================================*/
			if($testimonialsImage) {
				$sizeArr = getimagesize($testimonialsImage);
				
				$mainImageWidth = $sizeArr[0];
				$mainImageHeight = $sizeArr[1];
				
				$image = $this->testimonialsID.'_'.$this->coupleImage;
				
				$valueWidth = 242;
				$valueHeight = 307;
				
				$GdClient = new GdClient();
				$GdClient->saveResizedImage($testimonialsImage,$image,'testimonial_image','main',$valueWidth,$valueHeight,$mainImageWidth,$mainImageHeight);
			}
			/*============== unlink original image after resize =================*/
			
			$testimonialsImage = $testimonialsImagePath .'/main/org_'.$this->testimonialsID.'_'.$this->coupleImage;
			
			
			if(file_exists($testimonialsImage)) {
				unlink($testimonialsImage);
			}
			/*===========================================================*/
			
			$sql = "UPDATE app_testimonials SET coupleImage='$image' WHERE testimonialsID='$this->testimonialsID'";
					
			$cmd=$db->createCommand($sql);
			$cmd->execute();
		}
		
		return true;
	}
}
