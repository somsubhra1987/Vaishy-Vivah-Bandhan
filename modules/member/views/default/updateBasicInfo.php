<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\Core;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\modules\member\models\AppUser */
/* @var $form yii\widgets\ActiveForm */
$this->title = "Update Basic Info";
if($model->dob == '0000-00-00'){
    $model->dob = '';
}
?>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo Html::encode($this->title) ?> </h4>
        </div>
            
        <div class="mandate-asset-create">
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'dob')->widget(DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]) ?>

                <?= $form->field($model, 'profileCreatedFor')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'bodyType')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'height')->dropDownList(Core::getHeightList(), ['prompt' => ''])->label('Height (ft.)')?>

                <?= $form->field($model, 'physicalStatus')->dropDownList(['normal'=>'Normal', 'strong'=>'Strong'], ['prompt' => ''])->label('Physical Status')?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>