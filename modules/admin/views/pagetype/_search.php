<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsPageTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-page-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pageTypeID') ?>

    <?= $form->field($model, 'pageTypeCode') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'folderName') ?>

    <?= $form->field($model, 'listingOrder') ?>

    <?php // echo $form->field($model, 'showInSitemap') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
