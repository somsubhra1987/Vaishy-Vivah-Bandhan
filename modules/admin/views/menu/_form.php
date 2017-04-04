<?php
use app\lib\core\App;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\cms\models\CmsMenu;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsMenu */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
//  'onchange'=>"
//     $.ajax({
// 			type     :'POST',
// 			cache    : false,
// 			url  : Yii::$app->urlManager->createUrl(['menu/modulecontroller']),
// 			beforeSend => function(){
// 				
// 				},
// 			success => function(data){
// 				if(data) $("#controllerID").html(data);
// 				},
// 			data =>['moduleCode'=>'js:this.value'],	
// 				
// 	    });?>


<div class="cms-menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'parentID')->DropDownList($model->getMenuDropdownAssoc(),['prompt'=> '==Select=='])?>
    
    <?php echo $form->field($model, 'moduleCode')->DropDownList(App::getModuleAssoc(),['prompt'=> '==Select==',
    'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl(['admin/cms/menu/getcontrollerbymodule?moduleCode=']).'"+$(this).val(), function( data ) {
                  $( "#cmsmenu-controllerid" ).html( data );
                });
            ',
            ])
     ?> 
     
    
    <!--https://www.youtube.com/watch?v=Z6v9KeKDHjc-->
   <?php
   $moduleController = [];
   if(!$model->isNewRecord) $moduleController = CmsMenu::getModuleControllerAssoc($model->moduleCode);
   ?> 
    
    <?php echo $form->field($model, 'controllerID')->DropDownList($moduleController,['prompt'=> '==Select=='])->label('Controller Name')?> 
    

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
     <?php echo $form->field($model, 'menuCode')->textInput(['maxlength' => true]) ?>   

    <?php echo $form->field($model, 'linkUrl')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'listingOrder')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'target')->dropDownList([ '_blank' => ' blank', '_top' => ' top', '_parent' => ' parent', ], ['prompt' => '']) ?>

    <?php echo $form->field($model, 'active')->checkbox() ?>

    <?php echo $form->field($model, 'helpTips')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type ='text/javascript'>
function testfunction()
{
	alert('hello');	
}
</script>
