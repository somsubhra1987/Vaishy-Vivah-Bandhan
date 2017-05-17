<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Settings */
/* @var $form yii\widgets\ActiveForm */

$template = '<div class="row"><div class="col-md-2">{label}</div><div class="col-md-10">{input}{error}</div></div>';
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contactPerson', ['template' => $template])->textInput() ?>
    
    <?= $form->field($model, 'designation', ['template' => $template])->textInput() ?>
    
    <?= $form->field($model, 'address', ['template' => $template])->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contactNo', ['template' => $template])->textInput() ?>
    
    <?= $form->field($model, 'whatsappNo', ['template' => $template])->textInput() ?>
    
    <?= $form->field($model, 'emailID', ['template' => $template])->textInput() ?>
    
    <?= $form->field($model, 'facebookLink', ['template' => $template])->textInput() ?>
    
    <?= $form->field($model, 'twitterLink', ['template' => $template])->textInput() ?>
    
    <?= $form->field($model, 'gplusLink', ['template' => $template])->textInput() ?>
    
    <?= $form->field($model, 'youtubeLink', ['template' => $template])->textInput() ?>
    
    <?= $form->field($model, 'rssLink', ['template' => $template])->textInput() ?>
    
    <?= $form->field($model, 'mapLink', ['template' => $template])->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
