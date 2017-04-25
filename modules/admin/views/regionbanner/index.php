<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\cms\models\CmsRegionBannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cms Region Banners';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="cms-region-banner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
    <?php if (Yii::$app->session->hasFlash('bannerRegion')): ?>
		<div class="alert alert-success">
			<?= Yii::$app->session->getFlash('bannerRegion'); ?>
		</div>
	<?php endif; ?>
    
    <p>
        <?= Html::a('Add New Region', ['create'], ['class' => 'btn btn-success btn-position-right']) ?>
    </p>
    </br></br></br>
     <?php Pjax::begin(['id' => 'cms-block-grid','enablePushState' => FALSE])?> 
     
	<div class="grid-view" id="w0">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Description</th>
					<th>Banner Width</th>
					<th>Banner Height</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(!empty($bannerRegionArr))
					{
				       foreach($bannerRegionArr as $row)
				       {
						    $regionBannerID = $row['regionBannerID'];
							$title = stripslashes($row['title']);	
							$description = stripslashes($row['description']);	
							$bannerWidth = stripslashes($row['bannerWidth']);
							$bannerHeight = stripslashes($row['bannerHeight']);
							$bannerLimit = stripslashes($row['bannerLimit']);
							$needLink = stripslashes($row['needLink']);
							$url = Html::a('Add New Region', '/admin/cms/regionbanner/create', ['class' => 'btn btn-success btn-position-right'])
				?>
				<tr data-key="4" class="row4">
					<td><?=$regionBannerID; ?></td>
					<td><?=$title; ?></td>
					<td><?=$bannerWidth; ?></td>
					<td><?=$bannerHeight; ?></td>
					<td><?=$bannerLimit; ?></td>
					<td>
						<a class="yt-toggle collapsed" data-toggle="collapse"  href="#row<?=$regionBannerID; ?>">
							<span class="glyphicon glyphicon-plus"></span> <span class="glyphicon glyphicon-minus"></span>
						</a>
					</td>
					<td>
							<a href="/admin/cms/regionbanner/update?id=<?=$regionBannerID; ?>">
								<span class="glyphicon glyphicon-pencil"></span>
							 </a>
							<a data-method="post" data-confirm="Are you sure you want to delete this item?" title="Delete" href="/admin/cms/regionbanner/delete?id=<?=$regionBannerID; ?>">
							    <span class="glyphicon glyphicon-trash"></span>
							</a>
				     </td>
				</tr>
				<tr id="child<?=$regionBannerID; ?>">
				   <td colspan="7">
				   		<div id="row<?=$regionBannerID; ?>" class="collapse">
				   			<p><?= Html::a('Add New', ['create', 'regionId' => $regionBannerID], ['class' => 'btn btn-success btn-position-right']) ?></p>
							<?= GridView::widget([
						        'dataProvider' => $dataProvider,
						        'filterModel' => $searchModel,
						        'columns' => [
						            ['class' => 'yii\grid\SerialColumn'],

						            'title',
						             'active',
						             'listingOrder',
						
						            ['class' => 'yii\grid\ActionColumn'],
						        ],
						    ]); ?>
						  
						</div>
				   </td>
				</tr>
				<?php
					   }
			}	   
				?>
			</tbody>
	</table>
	</div>
	<?php Pjax::end();?>
</div>

<style>
	.yt-toggle.collapsed .glyphicon-minus {
		display: none;
	}
	
	.yt-toggle.collapsed .glyphicon-plus {
		display: inline-block;
	}
	
	.yt-toggle .glyphicon-plus {
		display: none;
	}
</style>