<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppAdmin */

$this->title = 'Create Admin User';
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['backUrl'] =  Yii::$app->urlManager->createAbsoluteUrl("admin/adminuser");
?>
<div class="app-admin-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
