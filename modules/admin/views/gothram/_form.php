<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\CustomFunctions;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Gothram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gothram-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'religionID')->dropDownList(CustomFunctions::getReligionAssoc(), ['prompt' => '--Select Religion--']) ?>

    <?= $form->field($model, 'gothram')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
