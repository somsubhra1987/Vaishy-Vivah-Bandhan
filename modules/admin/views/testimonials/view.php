<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Testimonials */

$this->title = $model->groomName.' & '.$model->brideName;
$this->params['breadcrumbs'][] = ['label' => 'Testimonials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testimonials-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->testimonialsID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->testimonialsID], [
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
            'testimonialsID',
            'groomName',
            'groomShortDescription:ntext',
            'brideName',
            'brideShortDescription:ntext',
            'coupleImage',
        ],
    ]) ?>

</div>
