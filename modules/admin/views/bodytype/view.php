<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BodyType */

$this->title = $model->bodyTypeID;
$this->params['breadcrumbs'][] = ['label' => 'Body Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="body-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bodyTypeID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bodyTypeID], [
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
            'bodyTypeID',
            'bodyType',
        ],
    ]) ?>

</div>
