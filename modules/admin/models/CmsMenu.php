<?php

namespace app\modules\admin\models;

use Yii;
use app\lib\Core; 
/**
 * This is the model class for table "cms_menu".
 *
 * @property string $menuID
 * @property string $parentID
 * @property string $menuCode
 * @property string $title
 * @property string $moduleCode
 * @property integer $controllerID
 * @property string $linkUrl
 * @property string $listingOrder
 * @property string $target
 * @property integer $active
 * @property string $helpTips
 */
class CmsMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parentID', 'controllerID', 'listingOrder'], 'default', 'value'=>'0'],
            [['parentID', 'menuCode', 'title', 'moduleCode', 'controllerID'], 'safe'],
            [['parentID', 'controllerID', 'active'], 'integer'],
            [['listingOrder'], 'number'],
            [['target', 'helpTips'], 'string'],
            [['menuCode', 'title', 'moduleCode'], 'string', 'max' => 50],
            [['linkUrl'], 'string', 'max' => 255],
            [['title', 'parentID'], 'unique', 'targetAttribute' => ['title', 'parentID'], 'message' => 'The combination of Parent ID and Title has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menuID' => 'Menu ID',
            'parentID' => 'Parent',
            'menuCode' => 'Menu Code',
            'title' => 'Title',
            'moduleCode' => 'Module Code',
            'controllerID' => 'Controller ID',
            'linkUrl' => 'Link Url',
            'listingOrder' => 'Listing Order',
            'target' => 'Target',
            'active' => 'Active',
            'helpTips' => 'Help Tips',
        ];
    }
    
    function getMenuTreeArray($parentID=0, $level=0, $tree=array())
	{
		$db = Yii::$app->db;
		$sql = "SELECT *, $level AS level
				FROM cms_menu
				WHERE active = 1
					AND parentID = '$parentID'
				ORDER BY listingOrder, title";
		$cmd=$db->createCommand($sql);
		$rows = $cmd->queryAll();

		foreach($rows AS $row) 
		{
			$menuID = $row['menuID'];
			$tree[] = $row;
			$tree = self::getMenuTreeArray($menuID, $level+1, $tree);
		}
		
		return $tree;
	}
	
    function getMenuDropdownAssoc()
	{
		$menuTreeArr = self::getMenuTreeArray();
		
		$rowArr = array();
		$currParentID = "";
		foreach($menuTreeArr as $arr)
		{
			$level    = $arr['level'];
			$menuID   = $arr['menuID'];
			$parentID = $arr['parentID'];
			$title    = $arr['title'];	
			
       		if($level <= 2)
       		{
				$sep = "";
				while($level-- >0) $sep .= "--->";
	         	$rowArr[$menuID] = $sep . $title;
         	}
     	}
         	
		return $rowArr;
	}
	
	function getModuleControllerAssoc($moduleCode)
	{
		$sql = "SELECT controllerID, controllerName
				FROM app_controller
					WHERE moduleCode = '$moduleCode'
				ORDER BY controllerName";
				
		return Core::getDropdownAssoc($sql);
	}
	
	function getParentMenuTitleByID($parentID)
	{
		$db = Yii::$app->db;
		$sql = "SELECT title 
				FROM cms_menu
				WHERE menuID = :menuID ";
					
		$cmd = $db->createCommand($sql);	
		$cmd->bindValue(":menuID", $parentID);
		return $cmd->queryScalar();		
	}
	
	function hasSubmenu($menuID)
	{
		$sql = "SELECT COUNT(menuID)
				FROM cms_menu
				WHERE parentID = :menuID";
		$count = Core::getData($sql, ['menuID'=>$menuID]);
		
		if($count) return true;
		
		return false;
	}
}
