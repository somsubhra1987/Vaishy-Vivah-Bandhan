<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppAdminGroup */

$this->title = 'Create Admin Group';
$this->params['breadcrumbs'][] = ['label' => 'Admin Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['backUrl'] =  Yii::$app->urlManager->createAbsoluteUrl("admin/admingroup");
?>
<div class="app-admin-group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
