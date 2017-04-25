<?php
namespace app\lib;

use Yii;
use app\lib\Core;

class Cms extends Core
{
	function createPage($pageTypeCode, $title, $templateDir, $refTable, $refID)
	{
		$db = Yii::$app->db;
		
		$pageTypeID = self::getPageTypeID($pageTypeCode);
		if(!$pageTypeID) return false;
		if(self::hasRefPage($refTable, $refID)) return false;

		$pageName = self::generatePageName($pageTypeID, $title, $suffix=0);
		
		$sql = "INSERT INTO cms_page (
					pageTypeID,
					templateDir,
					pageName,
					friendlyName,
					refTable,
					refID,
					seoTitle,
					seoDescription,
					seoKeyword,
					seoH1Headline,
					lastSeoUpdateOn,
					lastContentUpdateOn,
					altTag,
					dateCreated
				)
				VALUES (
					:pageTypeID,
					:templateDir,
					:pageName,
					:friendlyName,
					:refTable,
					:refID,
					:seoTitle,
					:seoDescription,
					:seoKeyword,
					:seoH1Headline,
					NOW(),
					NOW(),
					:altTag,
					NOW()
				)";
		
		$cmd = $db->createCommand($sql);
		$cmd->bindValue(':pageTypeID', $pageTypeID);
		$cmd->bindValue(':templateDir', $templateDir);
		$cmd->bindValue(':pageName', $pageName);
		$cmd->bindValue(':friendlyName', $title);
		$cmd->bindValue(':refTable', $refTable);
		$cmd->bindValue(':refID', $refID);
		$cmd->bindValue(':seoTitle', $title);
		$cmd->bindValue(':seoDescription', $title);
		$cmd->bindValue(':seoKeyword', $title);
		$cmd->bindValue(':seoH1Headline', $title);
		$cmd->bindValue(':altTag', $title);
		$cmd->execute();

		return true;
	}
	
	function hasRefPage($refTable, $refID)
	{
		$refTable = addslashes($refTable);
		$sql = "SELECT pageID
				FROM cms_page
				WHERE refTable = '$refTable'
					AND refID = " . (int)$refID;
		$pageID = self::getData($sql);
		
		if($pageID) return true;
		
		return false;
	}

	function getPageTypeID($pageTypeCode)
	{
		$pageTypeCode = addslashes($pageTypeCode);
		$sql = "SELECT pageTypeID
				FROM cms_page_type
				WHERE pageTypeCode = '$pageTypeCode'";
		$pageTypeID = self::getData($sql);
		
		return $pageTypeID;
	}
	
	function getPageTypeDir($pageTypeID)
	{
		$sql = "SELECT folderName
				FROM cms_page_type
				WHERE pageTypeID = " . (int)$pageTypeID;
		$folderName = self::getData($sql);

		return $folderName;
	}
	
	function generatePageName($pageTypeID, $title, $suffix=0)
	{
		if($suffix>0) $title .= $suffix;
		
		$pageName = trim(strtolower($title));
		$pageName = preg_replace("/[\s+]/", "-", $pageName);
		$pageName = preg_replace("/[^a-z0-9_-]/", "", $pageName);
		if(strlen($pageName)>100) $pageName = substr($pageName, 0, 100);
		
		$pageName = trim($pageName, "_");
		$pageName = trim($pageName, "-");
		
		$pageNameStr = addslashes($pageName);
		
		$sql = "SELECT COUNT(pageID)
				FROM cms_page
				WHERE pageName = '$pageNameStr'
					AND pageTypeID = " . (int)$pageTypeID;
		$count = self::getData($sql);
		if($count)
		{
			if($suffix>0)
			{
				$pageName = substr($pageName, 0, strlen($pageName)-strlen($suffix));
			}
			$pageName = self::generatePageName($pageTypeID, $pageName, $suffix+1);
		}
		
		return $pageName;
	}
	
	function getPageID($pageTypeDir, $pageName)
	{
		$pageTypeDir = addslashes($pageTypeDir);
		$pageName = addslashes($pageName);
		$sql = "SELECT pageID
				FROM cms_page P
					INNER JOIN cms_page_type PT USING(pageTypeID)
				WHERE P.pageName = '$pageName'
					AND PT.folderName = '$pageTypeDir'";
		$pageID = self::getData($sql);

		return $pageID;
	}
	
	function deletePage($refTable, $refID)
	{
		$db = Yii::$app->db;
		$sql = "DELETE 
				FROM cms_page 
					WHERE refTable = '$refTable' 
					AND refID = '$refID'";
		$cmd = $db->createCommand($sql);
		$cmd->execute();
		
		return true;
	}
	
	
	function getLeftMenuHtml($menuCode)
	{
		if($menuCode == "admin") $expanded = 1;
		else $expanded = 0;
		
		$menuCode = addslashes($menuCode);
		$sql = "SELECT menuID
				FROM cms_menu
				WHERE parentID = 0
					AND menuCode = '$menuCode'
					AND active = 1
					AND LENGTH(menuCode) > 0";
		$parentID = self::getData($sql);
		
		$html = self::getLeftMenuBox($parentID, $expanded);
		
		$html =<<<EOF
		<div class="left-col">
			$html
		</div>
EOF;
		
		return $html;
	}
	
	function getLeftMenuBox($parentID, $expanded)
	{
		if($expanded) $expandedText = "in";
		else $expandedText = "out";
		
		$db = Yii::$app->db;
		
		$sql = "SELECT menuID, menuCode, title
				FROM cms_menu
				WHERE parentID = :parentID
					AND active = 1
				ORDER BY listingOrder, title";
		$cmd = $db->createCommand($sql);
		$cmd->bindValue(':parentID', $parentID);
		$rows = $cmd->queryAll();
		
		$html = "";
		foreach($rows as $row)
		{
			$menuID = $row['menuID'];
			$menuCode = $row['menuCode'];
			$title = $row['title'];
			
			if(!self::getSubMenuCount($menuID))
			{
				$url = self::getMenuUrl($menuID);
				$html .= <<<EOF
<div class="list-group">
	<div class="list-group-item left-menu">
		<a href="$url">$title</a>
	</div>
</div>
EOF;
			}
			else
			{

			$html .=<<<EOF
<div class="list-group">
	<div class="list-group-item left-menu-cat" data-target="#left-menu-$menuID" data-toggle="collapse" aria-expanded="false" aria-controls="left-menu-$menuID">
		<div style="clear: both; overflow: hidden;">
			<div class="pull-left">$title</div>
			<div class="glyphicon glyphicon-menu-down pull-right" aria-hidden="true"></div>
		</div>
	</div>
	
	<div id="left-menu-$menuID" class="collapse $expandedText left-submenu-list">
EOF;

	$html .= self::getLeftMenuSub($menuID);
	
	$html .= <<<EOF
				</div>
			</div>
EOF;
			}
		}
		
		return $html;
	}
	
	function getLeftMenuSub($parentID, $level=0)
	{
		$db = Yii::$app->db;
		
		$sql = "SELECT *
				FROM cms_menu
				WHERE parentID = :parentID
					AND active = 1
				ORDER BY listingOrder, title";
		$cmd = $db->createCommand($sql);
		$cmd->bindValue(':parentID', $parentID);
		$rows = $cmd->queryAll();
		
		$html = "";
		foreach($rows as $row)
		{
			$menuID = $row['menuID'];
			$menuCode = $row['menuCode'];
			$title = stripslashes($row['title']);

			$url = self::getMenuUrl($menuID);
						
			$html .= <<<EOF

<div class="list-group-item"><a href="$url">$title</a></div>
EOF;
			
			$html .= self::getLeftMenuSub($menuID, $level+1);
		}
		
		return $html;
	}
	
	function getMenuUrl($menuID)
	{
		$menuID = addslashes($menuID);
		$sql = "SELECT moduleCode, controllerID, linkUrl
				FROM cms_menu
				WHERE menuID = '$menuID'
					AND active = 1";
		$row = self::getRow($sql);
		
		$moduleCode = $row['moduleCode'];
		$controllerID = $row['controllerID'];
		$linkUrl = $row['linkUrl'];
		
		$controllerName = strtolower(self::getControllerName($controllerID));
		$controllerName = substr($controllerName, 0, strlen($controllerName)-10);
		
		if(preg_match("/^(http|\/)/", $linkUrl))
		{
			$url = $linkUrl;
		}
		else
		{
			$url = Yii::$app->getUrlManager()->getBaseUrl();
			if(strlen($moduleCode)) $url .= "/" . $moduleCode;
			if(strlen($controllerName))
			{
				$url .= "/" . $controllerName;
				if($linkUrl) $url .= "/" . $linkUrl;
			}
		}
		
		return $url;
	}
	
	function getSubMenuCount($menuID)
	{
		$sql = "SELECT COUNT(menuID)
				FROM cms_menu
				WHERE active = 1
					AND parentID = " . (int)$menuID;
		$count = self::getData($sql);
		
		return $count;
	}
	
	function renderRegion($regionCode)
	{
		$db = Yii::$app->db;
		
		$pageID = $this->pageID;
		if(!$pageID) return;

		$sql = "SELECT
					RO.listingOrder, RO.regionObjectID,
					'cms_block' AS refTable, B.blockID AS refID
				FROM cms_page P
					INNER JOIN cms_block_display BD USING(pageID)
					INNER JOIN cms_block B USING(blockID)
					INNER JOIN cms_region_object RO ON(RO.refTable = 'cms_block' AND RO.refID = B.blockID)
					INNER JOIN cms_region R USING(regionID)
				WHERE (P.pageID = :pageID OR R.isShared = 1)
					AND R.regionCode = :regionCode
				
				UNION	
				
				SELECT
					RO.listingOrder, RO.regionObjectID,
					'cms_banner' AS refTable, B.bannerID AS refID
				FROM cms_page P
					INNER JOIN cms_banner_display BD USING(pageID)
					INNER JOIN cms_region_banner RB USING(regionBannerID)
					INNER JOIN cms_banner B USING(regionBannerID)
					INNER JOIN cms_region_object RO ON(RO.refTable = 'cms_region_banner' AND RO.refID = RB.regionBannerID)
					INNER JOIN cms_region R USING(regionID)
				WHERE (P.pageID = :pageID OR R.isShared = 1)
					AND R.regionCode = :regionCode
					
				ORDER BY listingOrder, regionObjectID	
					";
		
		echo <<<EOF
<div id="$regionCode" class="region">
EOF;
		
		$cmd = $db->createCommand($sql);
		$cmd->bindValue(':pageID', $pageID);
		$cmd->bindValue(':regionCode', $regionCode);
		$rows = $cmd->queryAll();
		
		foreach($rows as $row)
		{
			$refTable = $row['refTable'];
			$refID = $row['refID'];
			
			if($refTable == 'cms_block')
			{
	 			$block = CmsBlock::model()->findByPk($refID);
	 			
	 			$blockID = $block->blockID;
	 			$title = self::strip($block->title);
	 			$content = self::strip($block->content);
 			}
 			elseif($refTable == 'cms_banner')
			{
	 			$banner = CmsBanner::model()->findByPk($refID);
	 			
	 			$bannerID = $banner->bannerID;
	 			$bannerTypeCode = self::strip($banner->bannerTypeCode);
	 			$title = self::strip($banner->title);
	 			if($bannerTypeCode == 'html')
	 			{
		 			$content = self::strip($banner->htmlContent);
	 			}
	 			elseif($bannerTypeCode == 'text')
	 			{
		 			$content = self::strip($banner->textContent);
	 			}
	 			elseif($bannerTypeCode == 'image')
	 			{
		 			$image = $banner->image;
		 			$targetPage = self::strip($banner->targetPage);
		 			$targetFile = self::strip($banner->targetFile);
		 			$target = self::strip($banner->target);
		 			
		 			$imageLoc = "/cms_banner/org/org_" . $image;
		 			if(file_exists(self::getUploadedPath() . $imageLoc))
		 			{
			 			$imageUrl = self::getUploadedUrl() . $imageLoc;
			 			$content =<<<EOF
<img src="$imageUrl" alt="$title" />		 			
EOF;
		 			}
	 			}
	 			
	 			$title = "";
 			}

 			echo <<<EOF
<div id="block-$refTable-$refID" class="block">
EOF;

/*
	if(strlen($title))
	{
		echo <<<EOF
<div class="title">$title</div>
EOF;
	}
	*/

	echo <<<EOF
	<div class="content">$content</div>
</div>		
EOF;
		}

	echo <<<EOF
</div>	
EOF;
	}
	
	function getPageRefID($pageID)
	{
		$sql = "SELECT refID FROM cms_page WHERE pageID = " . (int)$pageID;
		$refID = self::getData($sql);
		
		return $refID;
	}
	
	function getPostPageName($postID)
	{
		$sql = "SELECT pageName
				FROM cms_page P
				WHERE P.refTable = 'blg_post'
					AND P.refID = ". (int)$postID;
		$pageName = self::getData($sql);
		return $pageName;
	}
	
	function getCategoryPageName($categoryID)
	{
		$sql = "SELECT pageName
				FROM cms_page P
				WHERE P.refTable = 'blg_category'
					AND P.refID = ". (int)$categoryID;
		$pageName = self::getData($sql);
		return $pageName;
	}
	
	function getTagPageName($tagID)
	{
		$sql = "SELECT pageName
				FROM cms_page P
				WHERE P.refTable = 'blg_tag'
					AND P.refID = ". (int)$tagID;
		$pageName = self::getData($sql);
		return $pageName;
	}
	
	function getPagePostID($pageID)
	{
		$sql = "SELECT P.refID AS postID
				FROM cms_page P
				WHERE P.refTable = 'blg_post'
					AND P.pageID = ". (int)$pageID;
		$postID = self::getData($sql);
		return $postID;
	}
	
	function getFaqs($faqCategoryCode = false)
	{
		if(!$faqCategoryCode)
		{
			$sql = "SELECT faqCatregoryCode
					FROM cms_faq_category
					ORDER BY listingOrder
					LIMIT 0, 1";
			$faqCategoryCode = self::getData($sql);
		}
		
		$sql = "SELECT F.faqID, F.question, F.answer
				FROM cms_faq F
					INNER JOIN cms_faq_category FC USING(faqCategoryID)
				WHERE FC.faqCatregoryCode = :faqCategoryCode
					AND F.active = 1
				ORDER BY F.listingOrder";
		$rows = self::getRows($sql, ['faqCategoryCode'=>$faqCategoryCode]);
		
		return $rows;
	}
	
	function getMenuTreeArray($parentID=0, $level=0, $tree=array())
	{
		$db = Yii::$app->db;
		$sql = "SELECT *, $level AS level
				FROM cms_menu
				WHERE parentID = '$parentID'
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
	
	function getPageDetail($pageID)
	{
		$db = Yii::$app->db;		
		$sql = "SELECT 
					* 
				FROM cms_page 
				WHERE pageID = :pageID ";
		$cmd = $db->createCommand($sql);
		$cmd->bindValue(':pageID',$pageID);
		return $data = $cmd->queryOne();			
	}
	
	/***Functions added by Sujit *****/
	
	function getSeoTitle($pageID)
	{		
		$data = self::getPageDetail($pageID);
		$friendlyName = $data["friendlyName"];
		$seoTitle = $data["seoTitle"];
		
		if(strlen($seoTitle)) return $seoTitle;
		else return $friendlyName;	
	}
	
	function getSeoDescription($pageID)
	{		
		$sql = "SELECT seoDescription
				FROM cms_page 
				WHERE pageID = :pageID ";		
		return Core::getData($sql, array(':pageID'=>$pageID));		
	}	
	
	function getSeoKeyword($pageID)
	{	
		$sql = "SELECT seoKeyword
				FROM cms_page 
				WHERE pageID = :pageID ";		
		return Core::getData($sql, array(':pageID'=>$pageID));		
	}
	
	function getSeoH1Headline($pageID)
	{		
		$sql = "SELECT seoH1Headline
				FROM cms_page 
				WHERE pageID = :pageID ";		
		return Core::getData($sql, array(':pageID'=>$pageID));		
	}	
	/***Functions added by Sujit *****/

	/***Functions added by chinmay *****/

	function getBlockContent($blockCode)
	{
		$sql = "SELECT 
					content 
				FROM cms_block 
				WHERE blockCode = :blockCode ";
		$content = Core::getData($sql, array(':blockCode'=>$blockCode));
		return $content;
	}

	public function getBannerByRegionCode($regionCode)
	{
		$sql = "SELECT 
					cb.image,
					cb.title 
				FROM cms_banner cb 
				INNER JOIN cms_region_banner rb ON cb.regionBannerID = rb.regionBannerID
				INNER JOIN cms_region_object ro ON rb.regionBannerID = ro.refID
				INNER JOIN cms_region cr ON ro.regionID = cr.regionID AND cr.regionCode = :regionCode ";
		$imageList = Core::getRows($sql, array(':regionCode'=>$regionCode));
		return $imageList;
	}
	
}