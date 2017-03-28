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
			<div class="panel panel-default">
				<div class="panel-heading">
	    			<h1 class="panel-title"><?php echo $this->title ?></h1>
	    			<?php	    			
	    			if(isset($this->params['backUrl']))
	    			{
		    		?>
	    			<a href="<?php echo $this->params['backUrl'];?>"><span class="glyphicon glyphicon-arrow-left pull-right"></span></a>
					<?php
	    			}
	    			?>
	    		</div>
			
	    		<div class="panel-body">
	    			<?= $content ?>
	    		</div>
			</div>
		</div>
    </div>	       
</div>