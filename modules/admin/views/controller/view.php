<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppController */

$this->title = $model->controllerID;
$this->params['breadcrumbs'][] = ['label' => 'App Controllers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-controller-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->controllerID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->controllerID], [
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
            'controllerID',
            'moduleCode',
            'controllerName',
            'active',
        ],
    ]) ?>

</div>
