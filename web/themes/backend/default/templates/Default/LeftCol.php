<?php
use app\lib\Core;
use app\lib\Cms;
if(Core::getLoggedAdmin()->adminID)
{
	//App::printR(App::getLoggedAdmin());

	if(Core::getLoggedAdmin()->superFlag) 
	{
		echo Cms::getLeftMenuHtml('rp_admin');
	}
	elseif(Core::getLoggedAdmin()->groupCode == 'blog_admin') 
	{		
		echo Cms::getLeftMenuHtml('blog_admin');
	}
	else 
	{
		echo Cms::getLeftMenuHtml('admin');
	}
}
?>