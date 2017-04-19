<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\Query;
use yii\web\UploadedFile;
use app\lib\Core;
use app\lib\core\GdClient;
/**
 * This is the model class for table "cms_banner".
 *
 * @property string $bannerID
 * @property string $regionBannerID
 * @property string $bannerTypeCode
 * @property string $title
 * @property string $image
 * @property string $textContent
 * @property string $htmlContent
 * @property string $targetPage
 * @property string $targetFile
 * @property string $target
 * @property integer $active
 * @property string $dateTimeCreated
 * @property string $clickCount
 * @property string $listingOrder
 */
class CmsBanner extends \yii\db\ActiveRecord
{
    public $prevImageName;
	/**
     * @inheritdoc
     */
     
    public static function tableName()
    {
        return 'cms_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bannerTypeCode', 'title'], 'required'],            
            [['dateTimeCreated','regionBannerID', 'bannerTypeCode', 'title','image', 'textContent', 'htmlContent', 'targetPage', 'target'], 'safe'],
            [['listingOrder', 'clickCount'],'default','value'=>'0'],
            [['regionBannerID', 'bannerTypeCode', 'title', 'image', 'textContent', 'htmlContent', 'targetPage', 'target'],'default','value' =>''],
            [['regionBannerID', 'active', 'clickCount'], 'integer'],
            [['textContent', 'htmlContent', 'target'], 'string'],            
            [['listingOrder'], 'number'],          
			[['title'], 'string', 'max' => 100],
			[['image', 'targetPage', 'targetFile'], 'string', 'max' => 255],
			['image', 'file', 'extensions' => ['png', 'jpg', 'gif','jpeg']],
			['targetFile', 'file', 'extensions' => ['xls','xlsx','pdf','doc','docx','txt','ppt','pptx','zip','rtf','jpg','jpeg','png','gif']], 
			[['title'], 'unique','targetAttribute' => ['title'], 'message' => 'Title has already been taken'],                      
			[['title', 'regionBannerID'], 'unique', 'targetAttribute' => ['title', 'regionBannerID'], 'message' => 'The combination of Region Banner ID and Title has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bannerID' => 'Banner ID',
            'regionBannerID' => 'Region Banner',
            'bannerTypeCode' => 'Banner Type Code',
            'title' => 'Title',
            'image' => 'Image',
            'textContent' => 'Text Content',
            'htmlContent' => 'Html Content',
            'targetPage' => 'Target Page',
            'targetFile' => 'Target File',
            'target' => 'Target',
            'active' => 'Active',
            'dateTimeCreated' => 'Date Time Created',
            'clickCount' => 'Click Count',
            'listingOrder' => 'Listing Order',
        ];
    }
    
    
    public function getListBannerRegionArray()
	{
		$db = Yii::$app->db;
		
		$sql = "SELECT * 
				FROM cms_region_banner 
				WHERE 1 
				ORDER BY title";
		$cmd = $db->createCommand($sql );
		$rows = $cmd->queryAll();
		return $rows;
	}
	
	
	public function beforeSave()
	{		
		$this->dateTimeCreated = date('Y-m-d H:i:s');
		
		$this->image = UploadedFile::getInstance($this, 'image');				
		$this->targetFile = UploadedFile::getInstance($this, 'targetFile');	
			
		if(!$this->image){ $this->image = '';}
		if(!$this->targetFile){ $this->targetFile = '';}
		
		return true;
	}
	
	public function afterSave($insert, $changedAttributes)
	{					
			$db = Yii::$app->db;
			$path = Core::getUploadedPath();		
			
			if($this->image) 
			{			
				$bannerPath = $path .'/cms_banner';
				if(!is_dir($bannerPath)) {
				   mkdir($bannerPath);
				   chmod($bannerPath, 0777); 
			    }		
			    
			    $bannerMainPath = 	$bannerPath .'/main';
			    
			    if(!is_dir($bannerMainPath)) {
				   mkdir($bannerMainPath);
				   chmod($bannerMainPath, 0777); 
			    }	
				
				$sql = "SELECT image 
						FROM cms_banner 
						WHERE bannerID = '$this->bannerID'";
				$cmd = $db->createCommand($sql);
				$oldBannerImage = $cmd->queryScalar();
				
				$oldBannerImagePath = $bannerPath .'/main/main_'.$oldBannerImage;
				
				if(file_exists($oldBannerImagePath)) {
					unlink($oldBannerImagePath);
				}
				
				/*============== save original image ========================*/
				
				$bannerImage = $bannerPath .'/main/org_'.$this->bannerID.'_'.$this->image;
				
				$this->image->saveAs($bannerImage);
				
				/*===========================================================*/
				if($bannerImage) {
					$sizeArr = getimagesize($bannerImage);
					
					$mainImageWidth = $sizeArr[0];
					$mainImageHeight = $sizeArr[1];
					
					$image = $this->bannerID.'_'.$this->image;
							
					$sql = "SELECT bannerWidth, bannerHeight FROM cms_region_banner  WHERE regionBannerID =". $this->regionBannerID;
					$cmd = $db->createCommand($sql);
					$row = $cmd->queryAll();
					
					$valueWidth = $row[0]['bannerWidth'];
					$valueHeight = $row[0]['bannerHeight'];
					
					$GdClient = new GdClient();
					$GdClient->saveResizedImage($bannerImage,$image,'cms_banner','main',$valueWidth,$valueHeight,$mainImageWidth,$mainImageHeight);
				}
				/*============== unlink original image after resize =================*/
				
				$bannerImage = $bannerPath .'/main/org_'.$this->bannerID.'_'.$this->image;
				
				
				if(file_exists($bannerImage)) {
					unlink($bannerImage);
				}
				/*===========================================================*/
				
				$sql = "UPDATE cms_banner SET image='$image' WHERE bannerID='$this->bannerID'";
						
				$cmd=$db->createCommand($sql);
				$cmd->execute();
			}
			else
			{
				$sql = "UPDATE cms_banner SET 
					image='$this->prevImageName' 
					WHERE bannerID = '$this->bannerID' ";
						
				$cmd=$db->createCommand($sql);
				$cmd->execute();	
			}
			
			if($this->targetFile) 
			{		
				
				$bannerPath = $path .'/cms_banner';
				
				if(!is_dir($bannerPath)) {
				   mkdir($bannerPath);
				   chmod($bannerPath, 0777); 
			    }
			    
			    $bannerMainPath =  $bannerPath .'/main';
			    
			    if(!is_dir($bannerMainPath)) {
				   mkdir($bannerMainPath);
				   chmod($bannerMainPath, 0777); 
			    }
			    		   
				$sql = "SELECT targetFile 
						FROM cms_banner 
						WHERE bannerID = '$this->bannerID'";
				$cmd=$db->createCommand($sql);
				$oldTargetFile = $cmd->queryScalar();
				
				$oldTargetFilePath = $bannerPath .'/main/main_'.$oldTargetFile;
			
				if(file_exists($oldTargetFilePath) && $this->targetFile) {
					unlink($oldTargetFilePath);
				}
						
				$targateFile = $bannerPath .'/main/main_'.$this->bannerID.'_'.$this->targetFile;				
				$this->targetFile->saveAs($targateFile);
				
				$targetFile = $this->bannerID.'_'.$this->targetFile;
				
				$sql = "UPDATE cms_banner SET targetFile = '$targetFile' WHERE bannerID = '$this->bannerID'";
						
				$cmd=$db->createCommand($sql);
				$cmd->execute();
			}
		
		return true;
	}
	
	public function getbannerTypeName($bannerTypeCode)
	{
		return Core::getData("SELECT title FROM cms_banner_type WHERE bannerTypeCode = '$bannerTypeCode'");
	}
	
	public function selectedTargetFile($bannerID)
	{
		$db = Yii::$app->db;
		$sql = "SELECT targetFile 
					FROM cms_banner 
				WHERE bannerID = '$bannerID'";
		$cmd = $db->createCommand($sql);
		$targetFile = $cmd->queryScalar();
		
		$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
		$bannerUrl = $baseUrl .'/uploads/cms_banner/main/';
		$imageUrl = $bannerUrl .'main_'.$targetFile;
		if($targetFile)
				$previewImg = "<a href='" . $imageUrl . "' target='_blank'>".$targetFile."</a>";
		else
			$previewImg = "";
		
		return $previewImg;
	 }
	
	public function getBannerImage($bannerID)
	{
		
		$db = Yii::$app->db;	
		$sql = "SELECT image 
					FROM cms_banner 
				WHERE bannerID = '$bannerID'";
		$cmd=$db->createCommand($sql);
		$image = $cmd->queryScalar();
		
		$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
		$bannerUrl = $baseUrl .'/datafiles/uploaded/cms_banner/main/';
		
		$imageUrl = $bannerUrl .'main_'.$image;
		
		if($image)
				$previewImg = "<img src='" . $imageUrl . "' alt='preview' title='preview' border='0' height='35'/>";
		else
			$previewImg = "";
		
		return $previewImg;
	 }
}
