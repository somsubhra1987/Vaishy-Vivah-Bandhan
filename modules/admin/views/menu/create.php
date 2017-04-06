<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsMenu */

$this->title = 'Create Cms Menu';
$this->params['breadcrumbs'][] = ['label' => 'Menu Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$backUrl =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/menu/");
$this->params['backUrl'] = $backUrl;
?>
<div class="cms-menu-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
