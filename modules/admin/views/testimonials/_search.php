<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TestimonialsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testimonials-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'testimonialsID') ?>

    <?= $form->field($model, 'groomName') ?>

    <?= $form->field($model, 'groomShortDescription') ?>

    <?= $form->field($model, 'brideName') ?>

    <?= $form->field($model, 'brideShortDescription') ?>

    <?php // echo $form->field($model, 'coupleImage') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
