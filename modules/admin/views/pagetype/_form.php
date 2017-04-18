<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsPageType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-page-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pageTypeCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'folderName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'listingOrder')->textInput() ?>

    <?= $form->field($model, 'showInSitemap')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
