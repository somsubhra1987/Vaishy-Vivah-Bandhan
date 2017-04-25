<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\Core;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Testimonials */
/* @var $form yii\widgets\ActiveForm */

//$imagePath = $img = Url::to('@web/datafiles/testimonial_image/main/main_'.$model->coupleImage);
?>

<div class="testimonials-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'groomName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'groomShortDescription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'brideName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brideShortDescription')->textarea(['rows' => 6]) ?>
	
    <?php
		 if($model->isNewRecord)
		 {
			echo $form->field($model, 'coupleImage')->fileInput(['maxlength' => false]);
		 }
		else
		 {
		 	echo Html::img('@web/datafiles/testimonial_image/main/main_'.$model->coupleImage, ['class' => 'img-responsive', 'style' => 'cursor:pointer;', 'onclick' => 'openFileChoose();']);
		 	echo $form->field($model, 'coupleImage')->fileInput(['maxlength' => false, 'style' => 'display:none;'])->label(false);
		 }
	?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
function openFileChoose()
{
	document.getElementById("testimonials-coupleimage").click();
}
</script>