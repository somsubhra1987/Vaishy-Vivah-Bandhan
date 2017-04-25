<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\Core;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBanner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-banner-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data'] ]); ?>
	
    <?= $form->field($model, 'regionBannerID')->hiddenInput(['maxlength' => true]) ?>
    <div class="form-group">
    <?=Core::getBannerRegionTitle($model->regionBannerID); ?>
    </div>
    <?php  
	if($model->isNewRecord)
	{ 
		echo $form->field($model, 'bannerTypeCode')->dropDownList(Core::getBannerTypeAssoc(),['prompt'=> '==SELECT=='])->label('Banner Type');	
	} 
	else 
	{ 
		echo $form->field($model, 'bannerTypeCode')->hiddenInput();	
		echo " <div class='form-group'>";	 
		echo $model->getbannerTypeName($model->bannerTypeCode); 
		echo "</div>";
	} 
    ?>
    
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php
      if(!$model->isNewRecord) 
      { 
			if($model->bannerTypeCode == 'image' || $model->bannerTypeCode == 'slider_image') 
			{
				if($model->getBannerImage($model->bannerID)) 
				{
					echo $model->getBannerImage($model->bannerID);
					echo $form->field($model, 'image')->fileInput(['maxlength' => false]);	
				} 
				else 
				{
					echo $form->field($model, 'image')->fileInput(['maxlength' => false]);
				}	
				
				
				if($model->hasNeedLink($model->regionBannerID))
				{ 
					echo $form->field($model, 'targetPage')->textInput(['maxlength' => true]);
					
					if($model->selectedTargetFile($model->bannerID))  
					{
						echo $form->field($model, 'targetFile')->fileInput(['maxlength' => false]);
						echo $model->selectedTargetFile($model->bannerID); 
					} 
					else 
					{
						echo $form->field($model, 'targetFile')->fileInput(['maxlength' => false]);
					}
					
					echo  $form->field($model, 'target')->dropDownList([ '_blank' => ' blank', '_top' => ' top', '_parent' => ' parent', ], ['prompt' => '']); 
				} 
			}
			elseif ($model->bannerTypeCode == 'text') 
			{
				echo $form->field($model, 'textContent')->textarea(['rows' => 6]);
			}
			elseif($model->bannerTypeCode == 'html') 
			{
				echo $form->field($model, 'htmlContent')->textarea(['rows' => 6]);	
			}
	 } 
	 ?>
	
	
	<?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'listingOrder')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
