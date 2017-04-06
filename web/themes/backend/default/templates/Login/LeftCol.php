<?php
use app\lib\core\App;
use app\lib\core\Cms;
if(App::getLoggedAdmin()->adminID)
{
	if(App::getLoggedAdmin()->superFlag) echo Cms::getLeftMenuHtml('super_admin');
	else echo Cms::getLeftMenuHtml('admin');
}
?>