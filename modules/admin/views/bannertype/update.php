<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBannerType */

$this->title = 'Update Banner Type: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cms Banner Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->bannerTypeCode]];
$this->params['breadcrumbs'][] = 'Update';
$backUrl =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/bannertype/");
$this->params['backUrl'] = $backUrl;
?>
<div class="cms-banner-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
