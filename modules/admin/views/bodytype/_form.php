<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BodyType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="body-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bodyType')->textInput(['maxlength' => true, 'autofocus' => 'autofocus']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
