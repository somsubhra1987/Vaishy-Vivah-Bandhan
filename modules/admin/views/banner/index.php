<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\lib\CustomHtml;
//use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\cms\models\CmsBannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banner List';
$this->params['breadcrumbs'][] = 'Banner Management';
?>
<div class="cms-banner-index">  
 
    <?php echo CustomHtml::getFlash();?>

	<p>
	  <?= Html::a('Add New', Yii::$app->urlManager->createUrl('admin/cms/regionbanner/create'), ['class' => 'btn btn-success btn-position-right']) ?>
	</p>
	
	</br></br></br>
	
    <div class="grid-view" id="w0">
		<table class="listParent table table-striped table-bordered"  cellspacing="1" cellpadding="3">
			<thead>
				<tr>
					
					<th>Title</th>
					<th>Banner Width</th>
					<th>Banner Height</th>
					<th>Banner Limit</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php
				       foreach($bannerRegionArr as $row)
				       {					      	
						    $regionBannerID = $row['regionBannerID'];
							$title = stripslashes($row['title']);	
							$description = stripslashes($row['description']);	
							$bannerWidth = stripslashes($row['bannerWidth']);
							$bannerHeight = stripslashes($row['bannerHeight']);
							$bannerLimit = stripslashes($row['bannerLimit']);
							$needLink = stripslashes($row['needLink']);
							
							/*---------------URL CREATION---------------------*/
							$updateRegionbannerUrl =  Yii::$app->urlManager->createUrl(['admin/cms/regionbanner/update','id'=>$regionBannerID]);
							$redirectUrl = Yii::$app->urlManager->createUrl(['admin/cms/banner/']);
							$deleleUrl = Yii::$app->urlManager->createUrl(['admin/cms/banner/deleteregionbanner','id'=>$regionBannerID]);
							/*------------------------------------------------*/
							
							
							
							$queryParams['CmsBannerSearch']['regionBannerID'] = $regionBannerID;
				?>
				<tr data-key="4" class="row4">					
					<td><?=$title; ?></td>
					<td><?=$bannerWidth; ?></td>
					<td><?=$bannerHeight; ?></td>
					<td><?=$bannerLimit; ?></td>
					<td>
						<div class="toggle marginCenter" rel="<?=$regionBannerID; ?>"></div>
					</td>
					<td>
							<a href="<?php echo $updateRegionbannerUrl?>" title="Update">
								<span class="glyphicon glyphicon-pencil"></span>
							 </a>
							<?=Html::a('<span class="glyphicon glyphicon-trash"></span>','#', [
							'title' => Yii::t('yii', 'Delete'),
							'onclick'=>"if (confirm('Are you sure you want to delete this item?')) {
								$.ajax({
								    type     :'POST',
								    cache    : false,
								    url  : '$deleleUrl',
								    data:{regionBannerID:'$regionBannerID'},
								    dataType: 'json',							    
								    success  : function(response) {						      
								       
									       window.location.replace('$redirectUrl');
									     
								    }
								    })
								}",
							]);
							?>							
				     </td>
				</tr>
				<tr class="listChild">
				   <td colspan="6">
				   		<div class="tableChild" id="childOf<?=$regionBannerID; ?>">
				   			
				   			<p><?= Html::a('Add New', ['create', 'regionId' => $regionBannerID], ['class' => 'btn btn-success btn-position-right']) ?></p>
				   			<?php Pjax::begin(['id' => 'cms-banner-grid'.$regionBannerID, 'enablePushState'=> false])?> 
							<?= GridView::widget([
								'id'=> 'cms-grid-'.$regionBannerID,
						        'dataProvider' => $searchModel->search($queryParams),
						        'filterModel' => $searchModel,
						        'rowOptions'=>function($model){
							           if(Yii::$app->session->get('updateBannerId') == $model->bannerID){
							                return ['style' => 'background-color:lightblue;'];
							            }
							    },
						        'columns' => [
						            //['class' => 'yii\grid\SerialColumn'],

									'title',
									[
									'attribute' => 'active',
									'value'=> function($model) {
										return  ($model->active=='1') ? 'Yes' : 'No';
									 },
									],
									'listingOrder',
						
						            ['class' => 'yii\grid\ActionColumn',
						            'template'=>'{update}{delete}'],
						        ],
						    ]); ?>
						  <?php Pjax::end();?>
						</div>
				   </td>
				</tr>
				<?php
					   }
				?>
			</tbody>
	</table>
	</div>
</div>


<?php
$this->registerJsFile(Yii::$app->request->baseUrl.'/themes/backend/default/js/cmsbanner.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->request->baseUrl.'/themes/backend/default/css/cmsbanner.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
?>

