<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsMenu */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cms Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->menuID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->menuID], [
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
            'menuID',
            'parentID',
            'menuCode',
            'title',
            'moduleCode',
            'controllerID',
            'linkUrl:url',
            'listingOrder',
            'target',
            'active',
            'helpTips:ntext',
        ],
    ]) ?>

</div>
