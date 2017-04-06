<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppAdminGroup */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Admin Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-admin-group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->adminGroupID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->adminGroupID], [
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
            'adminGroupID',
            'adminGroupCode',
            'title',
            'super',
        ],
    ]) ?>

</div>
