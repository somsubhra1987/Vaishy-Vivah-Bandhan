<?php
use app\lib\core\App;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppController */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-controller-form">

    <?php $form = ActiveForm::begin(); 
    
    $ajaxUrl = Yii::$app->urlManager->createUrl('admin/controller/modulecontroller');
    ?>

    <?= $form->field($model, 'moduleCode')->dropDownList(App::getModuleAssoc(),['prompt'=>'==Select==',
    'onchange'=>"
			$.ajax({
				    type     :'POST',
				    cache    : false,
				    url  : '$ajaxUrl',
				    data:{moduleCode:this.value},				    			    						    
				    success: function(response) {
				     document.getElementById('appcontroller-controllername').outerHTML = response;
				    }
				    });
    ",
    ]) ?>

    <?= $form->field($model, 'controllerName')->dropDownList(App::getModuleControllerAssoc($model->moduleCode), ['prompt'=>'==Select==']) ?>
	
    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
