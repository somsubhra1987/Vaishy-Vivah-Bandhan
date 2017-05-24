<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProfilecreatedFor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profilecreated-for-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'createdFor')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
