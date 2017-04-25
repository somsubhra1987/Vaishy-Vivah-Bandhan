<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "cms_region".
 *
 * @property integer $regionID
 * @property string $themeDir
 * @property string $regionCode
 * @property string $title
 * @property integer $listingOrder
 * @property integer $isShared
 */
class CmsRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['themeDir', 'regionCode', 'title', 'isShared'], 'required'],
            [['listingOrder', 'isShared'], 'integer'],
            [['listingOrder'], 'default', 'value'=>'0'],
            [['themeDir'], 'string', 'max' => 50],
            [['regionCode', 'title'], 'string', 'max' => 100],
            [['title', 'themeDir'], 'unique', 'targetAttribute' => ['title', 'themeDir'], 'message' => 'The combination of Theme Dir and Title has already been taken.'],
            [['regionCode', 'themeDir'], 'unique', 'targetAttribute' => ['regionCode', 'themeDir'], 'message' => 'The combination of Theme Dir and Region Code has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'regionID' => 'Region ID',
            'themeDir' => 'Theme Dir',
            'regionCode' => 'Region Code',
            'title' => 'Title',
            'listingOrder' => 'Listing Order',
            'isShared' => 'Is Shared',
        ];
    }
    
    
    public function hasRegionTemplate($regionID)
    {
        $db = Yii::$app->db;        
       
        $sql = "SELECT CONCAT(',', regionIDs, ',') AS regionIDs
                    FROM cms_template              
                HAVING regionIDs LIKE '%,$regionID,%'";
               
        $cmd = $db->createCommand($sql);        
        $rows = $cmd->queryAll();
        $totCount = count($rows);        
       	return ($totCount>0)?false:true;  
      
    }
    
    public function hasRegionObject($regionID)
    {
	    
		$db = Yii::$app->db;
		$sql = "SELECT 
					count(regionID) as totCount 
				FROM cms_region_object 
				WHERE regionID =:regionID ";
		$cmd = $db->createCommand($sql);
		$cmd->bindValue(':regionID',$regionID);		
		$totCount = $cmd->queryScalar();
		return ($totCount>0)?false:true;  
	}
	
    public function beforeDelete()
    { 
		if(self::hasRegionObject($this->regionID) && self::hasRegionTemplate($this->regionID))
		{
			return true;	
		}
		return false;
	}
}
