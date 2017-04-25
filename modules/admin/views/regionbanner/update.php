<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsRegionBanner */

$this->title = 'Update Banner Region ' . ' ' . $model->regionBannerID;
$this->params['breadcrumbs'][] = ['label' => 'Banner Management', 'url' => ['banner/index']];
$this->params['breadcrumbs'][] = 'Update';
$this->params['backUrl'] =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/banner/");
?>
<div class="cms-region-banner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
