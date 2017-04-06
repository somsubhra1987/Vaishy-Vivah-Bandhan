<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppAdminGroup */

$this->title = 'Update Admin Group: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Admin Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->adminGroupID]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['backUrl'] =  Yii::$app->urlManager->createAbsoluteUrl("admin/admingroup");
?>
<div class="app-admin-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
