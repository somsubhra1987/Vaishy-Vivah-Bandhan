<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBannerType */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cms Banner Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-banner-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bannerTypeCode], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bannerTypeCode], [
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
            'bannerTypeCode',
            'title',
        ],
    ]) ?>

</div>
