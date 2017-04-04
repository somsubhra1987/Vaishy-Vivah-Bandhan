<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppController */

$this->title = 'Create Controller';
$this->params['breadcrumbs'][] = ['label' => 'App Controllers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['backUrl'] =  Yii::$app->urlManager->createAbsoluteUrl("admin/controller");
?>
<div class="app-controller-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
