<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsMenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'menuID') ?>

    <?= $form->field($model, 'parentID') ?>

    <?= $form->field($model, 'menuCode') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'moduleCode') ?>

    <?php // echo $form->field($model, 'controllerID') ?>

    <?php // echo $form->field($model, 'linkUrl') ?>

    <?php // echo $form->field($model, 'listingOrder') ?>

    <?php // echo $form->field($model, 'target') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'helpTips') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
