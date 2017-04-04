<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppController */

$this->title = 'Update App Controller: ' . ' ' . $model->controllerID;
$this->params['breadcrumbs'][] = ['label' => 'App Controllers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->controllerID, 'url' => ['view', 'id' => $model->controllerID]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['backUrl'] =  Yii::$app->urlManager->createAbsoluteUrl("admin/controller");
?>
<div class="app-controller-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
