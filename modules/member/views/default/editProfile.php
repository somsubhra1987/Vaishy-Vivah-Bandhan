<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\Core;
/* @var $this yii\web\View */
/* @var $model app\modules\member\models\AppUser */
/* @var $form yii\widgets\ActiveForm */
$this->title = "Edit Profile";
$imageList = Core::getAllUploadedImageByProfileID($model->userID);
//Core::printR($imageList);
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
                
                <?= $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => '']) ?>

                <?php echo $form->field($model, 'fileName')->fileInput(['accept' => 'image/*']);?>

                <div class="row">
                	<?php
                	if(!empty($imageList))
                	{
                		foreach($imageList as $key=>$imageData)
                		{
                			$isActive = ($imageData['showInDp'])? 'isActive' : '';
                			?>
                			<div class="col-md-3 profileImage">
                				<img id="<?=$imageData['imageID']?>" src="<?=$imageData['fileName']?>" class="img-thumbnail <?=$isActive?>"> 
                			</div>
                			<?php                			
                		}                	          
                	}
                	?>
                </div>

                
                <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'phoneNo')->textInput(['maxlength' => true]) ?>


                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerCss('
img::before{
    content: "Read this -";
    background-color: yellow;
    color: red;
    font-weight: bold;
}
')
?>