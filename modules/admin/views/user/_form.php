<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\Core;
use yii\jui\DatePicker;
use app\lib\CustomFunctions;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserMaster */
/* @var $form yii\widgets\ActiveForm */

$stateUrl = Yii::$app->getUrlManager()->createUrl(['admin/user/stateagainstcountry']);
$stateData = array();
if(!$model->isNewRecord)
{
	$stateData = CustomFunctions::getStateAssoc($model->country);
}
?>

<div class="user-master-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php
    echo $form->errorSummary($model);
    ?>
    <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList(['Male'=>'Male', 'Female'=>'Female'], ['prompt' => '--Select--']); ?>

    <?= $form->field($model, 'dob')->widget(DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userPassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phoneNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country')->dropDownList(Core::getCountryAssoc(), ['prompt' => '--Select--', 'onchange' => 'getState(this.value);']) ?>

    <?= $form->field($model, 'state')->dropDownList($stateData, ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'personalInfo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aboutFamily')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'partnerPreference')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'profileCreatedFor')->dropDownList(CustomFunctions::getProfileCreatedForAssoc(), ['prompt' => '--Select--']) ?>
    
    <?= $form->field($model, 'education')->dropDownList(CustomFunctions::getEducationAssoc(), ['prompt'=>'--Select--'])?>
                
	<?= $form->field($model, 'employmentSector')->dropDownList(CustomFunctions::getEmploymentSectorAssoc(), ['prompt'=>'--Select--'])?>

    <?= $form->field($model, 'occupation')->dropDownList(CustomFunctions::getOccupationAssoc(), ['prompt'=>'--Select--'])?>

    <?= $form->field($model, 'bodyType')->dropDownList(CustomFunctions::getBodyTypeAssoc(), ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'height')->dropDownList(Core::getHeightList(), ['prompt' => '--Select--'])->label('Height (ft.)')?>

    <?= $form->field($model, 'physicalStatus')->dropDownList(['normal'=>'Normal', 'strong'=>'Strong'], ['prompt' => '--Select--']);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    function getState(countryID)
    {
        $.ajax({
            method:'GET',
            dataType: 'json',
            url:'<?php echo $stateUrl; ?>',
            data:{countryID:countryID},
            beforeSend:function(){
                $("#usermaster-state").html('<option value="">--Select--</options>');
            },
            success:function(response) {
                $.each(response, function(i, value) {
                    $('#usermaster-state').append($('<option>').text(value).attr('value', i));
                });
            }
        });
    }
</script>