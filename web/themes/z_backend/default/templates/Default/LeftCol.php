<?php
use app\lib\core\App;
use app\lib\core\Cms;
if(App::getLoggedAdmin()->adminID)
{
	//App::printR(App::getLoggedAdmin());

	if(App::getLoggedAdmin()->superFlag) 
	{
		echo Cms::getLeftMenuHtml('rp_admin');
	}
	elseif(App::getLoggedAdmin()->groupCode == 'blog_admin') 
	{		
		echo Cms::getLeftMenuHtml('blog_admin');
	}
	else 
	{
		echo Cms::getLeftMenuHtml('admin');
	}
}
?>