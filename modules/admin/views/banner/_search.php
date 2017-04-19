<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBannerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-banner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bannerID') ?>

    <?= $form->field($model, 'regionBannerID') ?>

    <?= $form->field($model, 'bannerTypeCode') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'textContent') ?>

    <?php // echo $form->field($model, 'htmlContent') ?>

    <?php // echo $form->field($model, 'targetPage') ?>

    <?php // echo $form->field($model, 'targetFile') ?>

    <?php // echo $form->field($model, 'target') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'dateTimeCreated') ?>

    <?php // echo $form->field($model, 'clickCount') ?>

    <?php // echo $form->field($model, 'listingOrder') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
