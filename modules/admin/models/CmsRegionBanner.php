<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "cms_region_banner".
 *
 * @property string $regionBannerID
 * @property string $title
 * @property string $description
 * @property integer $bannerWidth
 * @property integer $bannerHeight
 * @property integer $bannerLimit
 * @property integer $needLink
 */
class CmsRegionBanner extends \yii\db\ActiveRecord
{
	public $regionID;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_region_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['regionID', 'title', 'description', 'bannerWidth', 'bannerHeight', 'bannerLimit', 'needLink'], 'required'],
            [['bannerWidth', 'bannerHeight', 'bannerLimit', 'needLink'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        	'regionID' => 'Region',
            'regionBannerID' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'bannerWidth' => 'Banner Width',
            'bannerHeight' => 'Banner Height',
            'bannerLimit' => 'Banner Limit',
            'needLink' => 'Need Link',
        ];
    }
    
    public function afterSave($insert,$changedAttributes)
    {	    
	    $db = Yii::$app->db;
	    $refTable = 'cms_region_banner';
	    
	    if($insert)
	    {		    
		    $sql = "INSERT cms_region_object SET 
		    		regionID = :regionID,
		    		refTable = :refTable,
		    		refID = :refID,
		    		listingOrder = '99'
		    		";
		    $cmd = $db->createCommand($sql);
		    $cmd->bindValue('regionID',$this->regionID);
		    $cmd->bindValue('refTable',$refTable);		   
		    $cmd->bindValue('refID',$this->regionBannerID);
		    $cmd->execute();
		}
		else
		{
			$sql = "UPDATE cms_region_object 
				SET
					regionID = :regionID
				WHERE refTable = :refTable
				AND refID = :refID ";					
			$cmd = $db->createCommand($sql);
			$cmd->bindValue(":regionID", $this->regionID);
			$cmd->bindValue(":refTable", $refTable);
			$cmd->bindValue(":refID", $this->regionBannerID);
			$cmd->execute();
		}
		return  true;
	}
    
}
