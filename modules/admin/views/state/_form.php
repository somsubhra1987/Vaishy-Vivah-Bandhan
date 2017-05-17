<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\Core;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\State */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="state-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'autofocus' => 'autofocus']) ?>

    <?= $form->field($model, 'countryID')->dropDownList(Core::getCountryAssoc(), ['prompt' => '--Select Country--']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
