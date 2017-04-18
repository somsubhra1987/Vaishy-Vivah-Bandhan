<?php

namespace app\modules\admin\models;

use Yii;
use app\lib\Core;
/**
 * This is the model class for table "cms_page".
 *
 * @property string $pageID
 * @property integer $pageTypeID
 * @property string $templateDir
 * @property string $pageName
 * @property string $friendlyName
 * @property string $content
 * @property string $refTable
 * @property string $refID
 * @property string $seoTitle
 * @property string $seoDescription
 * @property string $seoKeyword
 * @property string $seoH1Headline
 * @property string $extraHeader
 * @property string $altTag
 * @property string $dateCreated
 * @property string $lastSeoUpdateOn
 * @property string $lastContentUpdateOn
 * @property integer $showInSitemap
 * @property string $sitemapPriority
 * @property string $sitemapChangeFreq
 * @property string $listingOrder
 * @property integer $active
 */
class CmsPage extends \yii\db\ActiveRecord
{
	public $object_refID_refTable=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pageTypeID', 'pageName', 'friendlyName'], 'required'],            
            [['dateCreated','lastSeoUpdateOn','lastContentUpdateOn'],'default','value'=>date('Y-m-d H:i:s')],            
            [['pageTypeID', 'refID', 'showInSitemap', 'active'], 'integer'],
            [['content', 'seoDescription', 'seoKeyword', 'extraHeader', 'sitemapPriority', 'sitemapChangeFreq'], 'string'],
            [['content', 'seoTitle', 'seoDescription', 'seoKeyword', 'seoH1Headline', 'extraHeader', 'altTag', 'dateCreated', 'lastSeoUpdateOn', 'lastContentUpdateOn', 'templateDir'], 'safe'],
            [['content', 'seoTitle', 'seoDescription', 'seoKeyword', 'seoH1Headline', 'extraHeader', 'altTag', 'templateDir'],'default','value'=>''],
            [['listingOrder'], 'number'],
            [['listingOrder'], 'default', 'value'=>0],
            [['templateDir', 'pageName', 'friendlyName', 'altTag'], 'string', 'max' => 100],
            [['refTable'], 'string', 'max' => 50],
            [['seoTitle', 'seoH1Headline'], 'string', 'max' => 255],
            [['pageName', 'pageTypeID'], 'unique', 'targetAttribute' => ['pageName', 'pageTypeID'], 'message' => 'The combination of Page Type ID and Page Name has already been taken.'],
            [['refTable', 'refID'], 'unique', 'targetAttribute' => ['refTable', 'refID'], 'message' => 'The combination of Ref Table and Ref ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pageID' => 'Page ID',
            'pageTypeID' => 'Page Type ID',
            'templateDir' => 'Template Dir',
            'pageName' => 'Page Name',
            'friendlyName' => 'Friendly Name',
            'content' => 'Content',
            'refTable' => 'Ref Table',
            'refID' => 'Ref ID',
            'seoTitle' => 'Seo Title',
            'seoDescription' => 'Seo Description',
            'seoKeyword' => 'Seo Keyword',
            'seoH1Headline' => 'Seo H1 Headline',
            'extraHeader' => 'Extra Header',
            'altTag' => 'Alt Tag',
            'dateCreated' => 'Date Created',
            'lastSeoUpdateOn' => 'Last Seo Update On',
            'lastContentUpdateOn' => 'Last Content Update On',
            'showInSitemap' => 'Show In Sitemap',
            'sitemapPriority' => 'Sitemap Priority',
            'sitemapChangeFreq' => 'Sitemap Change Freq',
            'listingOrder' => 'Listing Order',
            'active' => 'Active',
        ];
    }
    
    public function afterSave($insert, $changedAttributes)
    {
	    	$db = Yii::$app->db;
		/* insert into cms_block */
			if($insert)
			{				
				$blockCodeName = str_replace('.php', "", $this->pageName);
				$blockCodeName = str_replace("-", "_", $blockCodeName);
				$blockCode = $blockCodeName."_content";
				
				$title = str_replace("-", " ", $blockCodeName);
				$title = $title." content";
				$content = $this->content;
							
				
				$sql = "INSERT cms_block 
						SET
							blockCode = :blockCode,
							title = :title,
							content = :content";
							
				$cmd=$db->createCommand($sql);
				$cmd->bindValue(":blockCode", $blockCode);
				$cmd->bindValue(":title", $title);
				$cmd->bindValue(":content", $content);
				$cmd->execute();
				
				$blockID = Yii::$app->db->getLastInsertID();
				
				$refTable = 'cms_block';
				$refID = $blockID;
				$listingOrder = '99';
				
			/* insert into cms_block_display */
				
				$sql = "INSERT cms_block_display 
						SET
							blockID = :blockID,
							pageTypeID = :pageTypeID,
							pageID = :pageID";
							
				$cmd=$db->createCommand($sql);
				$cmd->bindValue(":blockID", $blockID);
				$cmd->bindValue(":pageTypeID", $this->pageTypeID);
				$cmd->bindValue(":pageID", $this->pageID);
				$cmd->execute();	
				
		}
		else
		{			
			$sql = "SELECT 
						blockID
					FROM cms_block_display
					WHERE pageID = '$this->pageID'";
			
			$blockID = Core::getData($sql);
			if($blockID)
			{			
				$sql = "UPDATE cms_block 
						SET
							content = :content
						WHERE blockID = '$blockID'";
							
				$cmd=$db->createCommand($sql);
				$cmd->bindValue(":content", $this->content);
				$cmd->execute();
			}			
		}
		return true;
	}	
	
    public function getListPageTypeArray()
	{
		$db = Yii::$app->db;
		
		$sql = "SELECT
					 * 
				FROM cms_page_type 
				WHERE 1 
				ORDER BY listingOrder,title";
		$cmd=$db->createCommand($sql);
		$rows = $cmd->queryAll();
		return $rows;
	}
	
	public function deletePageTypeByID($pageTypeID)
	{
		$db = Yii::$app->db;
		$sql = "SELECT 
					count(*) as totData
				FROM cms_page
				WHERE 
				pageTypeID = '$pageTypeID'";					
		$cmd = $db->createCommand($sql);
		$rows = $cmd->queryScalar();
		if(!$rows)
		{		
			$db->createCommand()->delete('cms_page_type', 'pageTypeID ='. $pageTypeID)->execute();
			return true;						
		}
		return false;
	}
	
	function getRegionObjects($regionID)
	{
		$objects = array();
		
		$db = Yii::$app->db;

		$sql = "SELECT 
					*
				FROM cms_region_object
				WHERE regionID = :regionID";
		$cmd = $db->createCommand($sql);
		$cmd->bindValue(':regionID', $regionID);
		$rows = $cmd->queryAll();
		foreach($rows as $row)
		{
			$objects[$row['regionObjectID']] = $row;
		}
		
		return $objects;
	}
	
	public function deleteObjectRegion($pageID, $refID, $refTable)
	{
		$db = Yii::app()->db;
		if($refTable == 'cms_block')
		{
			$dspTable = 'cms_block_display';
			$dspPk = 'blockID';
		}
		if($dspTable)
		{
		$sql = "DELETE FROM $dspTable WHERE $dspPk = '$refID' AND pageID = '$pageID'";
		$cmd=$db->createCommand($sql);
		$cmd->execute();
		}
		
		return true;
	}
}
