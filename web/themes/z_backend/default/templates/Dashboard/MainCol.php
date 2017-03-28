<?php
use yii\widgets\Breadcrumbs;
use app\lib\core\App;
?>
<div class="container">
<?php echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'homeLink' => [
        				'label' => "Dashboard",
        				'url' => App::getRootUrl() . "/admin/dashboard"
        			],
    ]) 
?>
	<div class="row">
		<div class="col-md-3"><?php include "LeftCol.php";?></div>
		
		<div class="col-md-9">
			<?= $content ?>
		</div>
    </div>	       
</div>