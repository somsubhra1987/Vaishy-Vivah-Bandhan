<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\admin\cms\models\CmsMenu;
use app\lib\core\RpHtml;
use app\lib\core\Cms;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\cms\models\CmsMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Management';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo RpHtml::getFlash() ?>

<?php
$menuArr = Cms::getMenuTreeArray();

$cms_menu="<table width='500' align='left' border=0 cellpadding=0>";
foreach($menuArr as $arr)
{
	$level = $arr['level'];
	$menuID = $arr['menuID'];
	$parentID = $arr['parentID'];
	$title = $arr['title'];
	$linkUrl = $arr['linkUrl'];
	$target = $arr['target'];
	
	
	$cms_menu .= "<tr class=\"tree-level".$level."\"><td style=\"line-height: 16px;border:0px solid#cccccc;\">";
	
	$editUrl =  Yii::$app->urlManager->createUrl(["admin/cms/menu/update", "id"=>$menuID]);
	$editLink = '<a class="edit" href="'. $editUrl .'"><span class="glyphicon glyphicon-pencil"></span></a>';
	
	
	$addUrl =  Yii::$app->urlManager->createUrl(["admin/cms/menu/create", "id"=>$menuID]);
	$addLink = '<a class="add" href="'. $addUrl .'"><span class="glyphicon glyphicon-plus"></span></a>';
	
	$redirectUrl = Yii::$app->urlManager->createUrl(['admin/cms/menu']);
	$deleleUrl = Yii::$app->urlManager->createUrl(['admin/cms/menu/delete?id=' . $menuID]);
	$deleteLink = Html::a('<span class="glyphicon glyphicon-remove"></span>','javascript:;', [
						'title' => Yii::t('yii', 'Delete'),
						'onclick'=>"if (confirm('Are you sure you want to delete this item?')) {
							$.ajax({
							    type     :'POST',
							    cache    : false,
							    url  : '$deleleUrl',
							    dataType: 'json',							    
							    success  : function(response) {						       
								       window.location.replace('$redirectUrl');							    
							    }
							    })
							}",
							'class'=>'delete',
						]);

	$menuTitle = "<span>".$title."</span>";	
	if($level <= 2)
    {
	$cms_menu .= $menuTitle."&nbsp;&nbsp;&nbsp;&nbsp;".$addLink."&nbsp;".$editLink."&nbsp;&nbsp;".$deleteLink;
	} else {
	$cms_menu .= $menuTitle."&nbsp;&nbsp;&nbsp;&nbsp;".$editLink."&nbsp;".$deleteLink;
	}
	
	
	
	$cms_menu.= "</td></tr>";	
}
$cms_menu.="</table>";
?>
<div id='menu-tree'>
<?php
echo $cms_menu;
?>