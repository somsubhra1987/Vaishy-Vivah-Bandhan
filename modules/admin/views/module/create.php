<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppModule */

$this->title = 'Create Module';
$this->params['breadcrumbs'][] = ['label' => 'Module Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$backUrl =  Yii::$app->urlManager->createAbsoluteUrl("admin/module");
$this->params['backUrl']=$backUrl;
?>
<div class="app-module-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
