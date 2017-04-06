<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\Core;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-master-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php
    echo $form->errorSummary($model);
    ?>
    <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList(['Male'=>'Male', 'Female'=>'Female'], ['prompt' => '=Select=']); ?>

    <?= $form->field($model, 'dob')->widget(DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userPassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phoneNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'personalInfo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aboutFamily')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'partnerPreference')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'profileCreatedFor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bodyType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->dropDownList(Core::getHeightList(), ['prompt' => ''])->label('Height (ft.)')?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'physicalStatus')->dropDownList(['normal'=>'Normal', 'strong'=>'Strong'], ['prompt' => '']);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
