<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\Core;
/* @var $this yii\web\View */
/* @var $model app\modules\member\models\AppUser */
/* @var $form yii\widgets\ActiveForm */
$this->title = "Update Groom location";
$stateUrl = Yii::$app->getUrlManager()->createUrl(['member/default/stateagainstcountry'])
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
                <?= $form->field($model, 'country')->dropDownList(Core::getCountryAssoc(),['prompt' => 'Select']) ?>
                <?= $form->field($model, 'city')->dropDownList(['prompt' => 'Select']) ?>
                <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
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
                $("#usermaster-state").html('<option value="">---</options>');
            },
            success:function(response) {
                $.each(response, function(i, value) {
                    $('#usermaster-state').append($('<option>').text(value).attr('value', i));
                });
            }
        });
    }
</script>