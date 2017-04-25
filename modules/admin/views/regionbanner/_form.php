<?php
use app\lib\Core;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsRegionBanner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-region-banner-form">

    <?php $form = ActiveForm::begin(); ?>
    
	<?= $form->field($model, 'regionID')->dropDownList(Core::getRegionAssoc(), ['prompt' => '== SELECT ==']) ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bannerWidth')->textInput()->label('Banner Width (PX)') ?>

    <?= $form->field($model, 'bannerHeight')->textInput()->label('Banner Height (PX)') ?>

    <?= $form->field($model, 'bannerLimit')->textInput() ?>

    <?= $form->field($model, 'needLink')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
