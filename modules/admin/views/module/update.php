<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppModule */

$this->title = 'Update Module: ' . ' ' . $model->moduleCode;
$this->params['breadcrumbs'][] = ['label' => 'Module Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
$backUrl =  Yii::$app->urlManager->createAbsoluteUrl("admin/module");
$this->params['backUrl'] = $backUrl;
?>
<div class="app-module-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
