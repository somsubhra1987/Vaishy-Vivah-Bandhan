<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsRegionBanner */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cms Region Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-region-banner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->regionBannerID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->regionBannerID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'regionBannerID',
            'title',
            'description',
            'bannerWidth',
            'bannerHeight',
            'bannerLimit',
            'needLink',
        ],
    ]) ?>

</div>
