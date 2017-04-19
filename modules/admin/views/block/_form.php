<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBlock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-block-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'blockCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(),[           
                'preset' => 'full',            
     ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success btn-action-right' : 'btn btn-primary btn-action-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
