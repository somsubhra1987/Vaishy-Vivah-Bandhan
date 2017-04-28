<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserUploadedImages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-uploaded-images-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fileName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refID')->textInput() ?>

    <?= $form->field($model, 'refTable')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adminVerifiedStatus')->textInput() ?>

    <?= $form->field($model, 'showInDp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
