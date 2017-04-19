<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBanner */

$this->title = 'Update Banner: ' . ' ' . $model->regionBannerID;
$this->params['breadcrumbs'][] = ['label' => 'Banner Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
$this->params['backUrl'] =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/banner/#".$model->regionBannerID);

?>
<div class="cms-banner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
