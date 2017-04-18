<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\lib\Core;
use app\lib\CustomHtml;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\cms\models\CmsPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Page List';
$this->params['breadcrumbs'][] = 'Page Management';

$addUrl =  Yii::$app->urlManager->createUrl("admin/pagetype/create");
?>
<div class="cms-page-index">
    
    
    <?php echo CustomHtml::getAddNewButton($addUrl, 'New Page Type') ?>
    
	<div class="grid-view">
	    <table class="table table-bordered">
			<thead>
				<tr>
					<th width="30"></th>	        
					<th>Title</th>
					<th>Page Type Code</th>
					<th></th>	
					<th width="30"></th>   
				</tr>
			</thead>
			
			<tbody>
			<?php
			foreach($pageTypeArr as $row)
			{
				$openFlg = 0;
				$pageTypeID = $row['pageTypeID'];
				$pageTypeCode = stripslashes($row['pageTypeCode']);	
				$title = stripslashes($row['title']);	
				
				/*---------------URL CREATION---------------------*/
				$updatePagetypeUrl =  Yii::$app->urlManager->createUrl(['admin/cms/pagetype/update','id'=>$pageTypeID]);
				$redirectUrl = Yii::$app->urlManager->createUrl(['admin/cms/page/']);
				$delelePagetypeUrl = Yii::$app->urlManager->createUrl(['admin/cms/page/deletepagetype']);
				/*------------------------------------------------*/
				
				$searchModel->pageTypeID = $pageTypeID;				
				
			?>
				<tr>
					<td class="text-center"><a class="Update" href="<?php echo $updatePagetypeUrl; ?>" title="Update"><span class="glyphicon glyphicon-pencil"></span></a></td>
					<td><?=$title;?></td>
					<td><?=$pageTypeCode;?></td>
					<td class="text-center"><div class="toggle marginCenter" rel="<?php echo $pageTypeID; ?>"></div></td>
					<td class="text-center">
					<?php
					if(Core::getLoggedAdmin()->superFlag)
					{
						?>
						<?=Html::a('<span class="glyphicon glyphicon-trash"></span>','#', [
						'title' => Yii::t('yii', 'Delete'),
						'onclick'=>"if (confirm('Are you sure you want to delete this item?')) {
							$.ajax({
							    type     :'POST',
							    cache    : false,
							    url  : '$delelePagetypeUrl',
							    data:{pageTypeID:'$pageTypeID'},
							    dataType: 'json',							    
							    success  : function(response) {							       
							       
								       window.location.replace('$redirectUrl');
								     
							    }
							    })
							}",
						]);
						?>
					<?php
					}
					?>	
					</td>
				</tr>				
				<tr style="display: none;" class='collapseSection'>
					<td colspan="5">													
							<?php
							if(Yii::$app->getSession()->hasFlash('pageTypeID') && Yii::$app->getSession()->getFlash('pageTypeID') == $pageTypeID)
							{
								echo CustomHtml::getFlash();							
							}
							?>
							<table class="table table-bordered">						
							<tr>
								<td>
								<p>
								<?= Html::a('Add New', ['create','id'=>$pageTypeID], ['class' => 'btn btn-success btn-position-right']) ?>
								</p>						
									<?php Pjax::begin(['id'=>'page-grid'.$pageTypeID, 'timeout' => 10000, 'enablePushState'=>false])?>
									    <?= GridView::widget([
									    	'id' => 'gridView'.$pageTypeID,
									        'dataProvider' =>  $searchModel->search($searchModel->pageTypeID),
											'rowOptions'=>function($data){
												if($data->pageID == Yii::$app->session['pageID']){
												return ['class' => 'danger'];
												}
											},							        
									        'columns' => [
									        	CustomHtml::getEditActionIcon(),
									            
									        	'pageName',
									            'friendlyName',
									            'refTable',							             
									
									            CustomHtml::getDeleteActionIcon(),
									        ],
									    ]); ?>
									<?php Pjax::end(); ?>						
								</td>
							</tr>
						</table>
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
$this->registerJsFile(Yii::$app->request->baseUrl.'/themes/backend/default/js/admin.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>