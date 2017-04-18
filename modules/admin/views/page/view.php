<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsPage */

$this->title = $model->pageID;
$this->params['breadcrumbs'][] = ['label' => 'Cms Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pageID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pageID], [
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
            'pageID',
            'pageTypeID',
            'templateDir',
            'pageName',
            'friendlyName',
            'content:ntext',
            'refTable',
            'refID',
            'seoTitle',
            'seoDescription:ntext',
            'seoKeyword:ntext',
            'seoH1Headline',
            'extraHeader:ntext',
            'altTag',
            'dateCreated',
            'lastSeoUpdateOn',
            'lastContentUpdateOn',
            'showInSitemap',
            'sitemapPriority',
            'sitemapChangeFreq',
            'listingOrder',
            'active',
        ],
    ]) ?>

</div>
