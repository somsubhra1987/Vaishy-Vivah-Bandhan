<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProfilecreatedFor */

$this->title = $model->createdFor;
$this->params['breadcrumbs'][] = ['label' => 'Profilecreated Fors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profilecreated-for-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
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
            'ID',
            'createdFor',
        ],
    ]) ?>

</div>
