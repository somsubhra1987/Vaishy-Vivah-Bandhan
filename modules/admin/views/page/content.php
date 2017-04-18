<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\core\App;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\cms\models\CmsPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Content';
$this->params['breadcrumbs'][] = $this->title;
$backUrl =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/page/");
$this->params['backUrl']=$backUrl;
$regions = App::getPageRegions($model->templateDir);
?>
<div class="cms-page-index" id="page-mgt-grid">
    <div id="statusMsg"></div>
    <?php 
    
	if($regions) 
	{ 
		foreach($regions as $regionID=>$regionTitle) 
		{
			$objects = $model->getPageRegionObjects($model->pageID, $regionID);			
			?>
			<div class="row form-group">
				<div class="col-md-12">
					<div class="col-sm-6"><?php echo $regionTitle;?></div>
					<div class="col-sm-6">
						<?php 
						$regionObjectOptions = $model->getPageRegionObjectAssoc($model->pageID, $regionID);						
						?>
						<?= Html::activeDropDownList($model, 'object_refID_refTable[]', $regionObjectOptions);?>
					</div>
				</div>
				
				<div class="row">
					<?php
					$deleteobjectregion = Yii::$app->urlManager->createUrl( ['deleteobjectregion']);
					foreach($objects as $value)
					{
						$refID = $value['refID'];
						$refTable = $value['refTable'];
						$title = $model->getObjectTitle($refID,$refTable);	
						?>
						<div class="col-md-12">
							<div class="col-sm-6"><?php echo $title; ?></div>
							<div class="col-sm-6">
							<?=Html::a('<span class="glyphicon glyphicon-trash"></span>','#', [
							'title' => Yii::t('yii', 'Delete'),
							'onclick'=>"if (confirm('Are you sure you want to delete this item?')) {
								$.ajax({
								    type     :'POST',
								    cache    : false,
								    url  : '$deleteobjectregion',
								    data:{refID:'$refID', refTable:'$refTable',pageID:'$model->pageID'},
								    dataType: 'json',							    
								    success  : function(response) {	
									    if(response.result==='success')							      
									       //window.location.replace('$redirectUrl');									     
									       $('#page-mgt-grid').html(response.renderData);
								       		$('#statusMsg').html(response.msg);
								    }
								    })
								}",
							]);
							?>
							</div>
						</div>
						<?php
					}
					?>
					
				</div>
			</div>			
			<?php
		}	    
	}    
	
	?>	
</div>