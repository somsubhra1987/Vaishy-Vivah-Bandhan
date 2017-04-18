<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsPageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-page-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pageID') ?>

    <?= $form->field($model, 'pageTypeID') ?>

    <?= $form->field($model, 'templateDir') ?>

    <?= $form->field($model, 'pageName') ?>

    <?= $form->field($model, 'friendlyName') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'refTable') ?>

    <?php // echo $form->field($model, 'refID') ?>

    <?php // echo $form->field($model, 'seoTitle') ?>

    <?php // echo $form->field($model, 'seoDescription') ?>

    <?php // echo $form->field($model, 'seoKeyword') ?>

    <?php // echo $form->field($model, 'seoH1Headline') ?>

    <?php // echo $form->field($model, 'extraHeader') ?>

    <?php // echo $form->field($model, 'altTag') ?>

    <?php // echo $form->field($model, 'dateCreated') ?>

    <?php // echo $form->field($model, 'lastSeoUpdateOn') ?>

    <?php // echo $form->field($model, 'lastContentUpdateOn') ?>

    <?php // echo $form->field($model, 'showInSitemap') ?>

    <?php // echo $form->field($model, 'sitemapPriority') ?>

    <?php // echo $form->field($model, 'sitemapChangeFreq') ?>

    <?php // echo $form->field($model, 'listingOrder') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
