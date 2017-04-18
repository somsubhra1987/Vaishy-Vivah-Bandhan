<?php
use app\lib\Core;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pageTypeID')->dropdownlist(Core::getPageTypeAssoc(),['prompt'=>'--Select--'])->label('Page Type') ?>

    <?= $form->field($model, 'pageName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'friendlyName')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'content')->widget(CKEditor::className(),[           
                'preset' => 'full',            
     ]); ?>

    <?= $form->field($model, 'seoTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoDescription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'seoKeyword')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'seoH1Headline')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extraHeader')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'altTag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'showInSitemap')->checkbox() ?>

    <?= $form->field($model, 'sitemapPriority')->dropDownList([ '0.1' => '0.1', '0.2' => '0.2', '0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1.0' => '1.0', ], ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'sitemapChangeFreq')->dropDownList([ 'hourly' => 'Hourly', 'daily' => 'Daily', 'weekly' => 'Weekly', 'monthly' => 'Monthly', 'yearly' => 'Yearly', 'never' => 'Never', ], ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'listingOrder')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
