<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Testimonials */

$this->title = 'Update Testimonials: ' . $model->testimonialsID;
$this->params['breadcrumbs'][] = ['label' => 'Testimonials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->testimonialsID, 'url' => ['view', 'id' => $model->testimonialsID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="testimonials-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
