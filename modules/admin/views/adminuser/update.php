<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppAdmin */

$this->title = 'Update Admin User: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->adminID, 'url' => ['view', 'id' => $model->adminID]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['backUrl'] =  Yii::$app->urlManager->createUrl("admin/adminuser");
?>
<div class="app-admin-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
