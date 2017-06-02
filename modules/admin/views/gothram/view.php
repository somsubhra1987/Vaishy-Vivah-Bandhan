<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Gothram */

$this->title = $model->gothram;
$this->params['breadcrumbs'][] = ['label' => 'Gothrams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gothram-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->gothramID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->gothramID], [
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
            'gothramID',
            'religionID',
            'gothram',
        ],
    ]) ?>

</div>
