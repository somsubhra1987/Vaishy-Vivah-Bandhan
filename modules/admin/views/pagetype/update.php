<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsPageType */

$this->title = 'Update PageType: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Page Management', 'url' => ['page/index']];
$this->params['breadcrumbs'][] = 'Update';
$this->params['backUrl'] =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/page/");
?>
<div class="cms-page-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
