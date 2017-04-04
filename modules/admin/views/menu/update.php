<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsMenu */

$this->title = 'Update Menu: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Menu Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->menuID]];
$this->params['breadcrumbs'][] = 'Update';
$backUrl =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/menu/");
$this->params['backUrl'] = $backUrl;

?>
<div class="cms-menu-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
