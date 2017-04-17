<?php
use app\lib\Core;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppAdmin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-admin-form">
	
    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo $form->errorSummary($model);
    ?>
    <?= $form->field($model, 'adminGroupID')->dropDownList(Core::getAdminGroupAssoc(),['prompt'=>'==SELECT=='])->label('Admin Group') ?>
    
	<?php 
	if($model->isNewRecord) 
	{ 
	?>	
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>    
	<?php 
	}
	?>
	
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'countryCode')->dropDownList(Core::getCountryAssoc(),['prompt'=>'==SELECT=='])->label('Country') ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'signature')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>
    
    <div class = 'change-password'>
	<?php
    if(!$model->isNewRecord)
    {
	?>
	<?= $form->field($model, 'password')->passwordInput(['value'=>'','maxlength' => true]) ?> 
	<?= $form->field($model, 'confirmpassword')->passwordInput(['value'=>'','maxlength' => true]) ?> 
	<?php 
	}
	?>
	</div>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
