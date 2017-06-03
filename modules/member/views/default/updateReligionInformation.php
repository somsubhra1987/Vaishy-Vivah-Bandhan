<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\CustomFunctions;

/* @var $this yii\web\View */
/* @var $model app\modules\member\models\AppUser */
/* @var $form yii\widgets\ActiveForm */
$this->title = "Update Religion Information";

$gothramAssoc = CustomFunctions::getGothramAssoc($model->religionID);
$casteAssoc = CustomFunctions::getCasteAssoc($model->religionID);
$gothramUrl = Yii::$app->getUrlManager()->createUrl(['member/default/gothramagainstreligion']);
$casteUrl = Yii::$app->getUrlManager()->createUrl(['member/default/casteagainstreligion']);
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

                <?= $form->field($model, 'religionID')->dropDownList(CustomFunctions::getReligionAssoc(), ['prompt'=>'--Select--', 'onchange' => 'getGothram(this.value); getCaste(this.value);'])?>
                                
                <?= $form->field($model, 'gothramID')->dropDownList($gothramAssoc, ['prompt'=>'--Select--'])?>
                
                <?= $form->field($model, 'casteID')->dropDownList($casteAssoc, ['prompt'=>'--Select--'])?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getGothram(religionID)
    {
        $.ajax({
            method:'GET',
            dataType: 'json',
            url:'<?php echo $gothramUrl; ?>',
            data:{religionID:religionID},
            beforeSend:function(){
                $("#usermaster-gothramid").html('<option value="">--Select--</options>');
            },
            success:function(response) {
                $.each(response, function(i, value) {
                    $('#usermaster-gothramid').append($('<option>').text(value).attr('value', i));
                });
            }
        });
    }
	
	function getCaste(religionID)
    {
        $.ajax({
            method:'GET',
            dataType: 'json',
            url:'<?php echo $casteUrl; ?>',
            data:{religionID:religionID},
            beforeSend:function(){
                $("#usermaster-casteid").html('<option value="">--Select--</options>');
            },
            success:function(response) {
                $.each(response, function(i, value) {
                    $('#usermaster-casteid').append($('<option>').text(value).attr('value', i));
                });
            }
        });
    }
</script>