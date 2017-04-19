<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "cms_banner_type".
 *
 * @property string $bannerTypeCode
 * @property string $title
 */
class CmsBannerType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_banner_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bannerTypeCode', 'title'], 'required'],
            [['bannerTypeCode', 'title'], 'string', 'max' => 50],
            [['title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bannerTypeCode' => 'Banner Type Code',
            'title' => 'Title',
        ];
    }
    
    public function beforeDelete()
    {
	   
	    $db = Yii::$app->db;	    	
		$sql = "SELECT count(*) as totRow 
				FROM cms_banner 
				WHERE bannerTypeCode = :bannerTypeCode ";
		$cmd = $db->createCommand($sql);
		$cmd->bindValue(':bannerTypeCode', $this->bannerTypeCode);		
		$totRow = $cmd->queryScalar();
		
		return ($totRow)?false:true;	
	}
}
