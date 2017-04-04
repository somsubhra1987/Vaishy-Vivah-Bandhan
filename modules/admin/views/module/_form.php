<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppModule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-module-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'moduleCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'moduleName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
