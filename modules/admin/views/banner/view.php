<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\lib\core\App;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBanner */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cms Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-banner-view">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bannerID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bannerID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'bannerID',
            //'regionBannerID',
            'bannerTypeCode',
            'title',
            [
	             'attribute' => 'image',
	             'format' => ['raw'],
	             'value'=> $model->getBannerImage($model->bannerID),
       		 ],
            'textContent:ntext',
            'htmlContent:ntext',
            'targetPage',
            'targetFile',
            'target',
            [
	             'attribute' => 'active',
	             'value'=> ($model->bannerID !=1) ? 'Yes' : 'No',
       		 ],
            //'dateTimeCreated',
           // 'clickCount',
            'listingOrder',
        ],
    ]) ?>
<p><?= Html::a('Back', ['/admin/cms/banner#'.$model->regionBannerID], ['class'=>'btn btn-primary']) ?></p>
</div>
