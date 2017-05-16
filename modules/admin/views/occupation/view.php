<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Occupation */

$this->title = $model->occupationID;
$this->params['breadcrumbs'][] = ['label' => 'Occupations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->occupationID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->occupationID], [
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
            'occupationID',
            'occupation',
        ],
    ]) ?>

</div>
