<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppModule */

$this->title = $model->moduleCode;
$this->params['breadcrumbs'][] = ['label' => 'App Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-module-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->moduleCode], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->moduleCode], [
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
            'moduleCode',
            'moduleName',
            'active',
        ],
    ]) ?>

</div>
