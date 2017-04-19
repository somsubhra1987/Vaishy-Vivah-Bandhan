<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBanner */

$this->title = 'Create Banner';
$this->params['breadcrumbs'][] = ['label' => 'Banner Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['backUrl'] =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/banner/#".$model->regionBannerID);
?>
<div class="cms-banner-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
