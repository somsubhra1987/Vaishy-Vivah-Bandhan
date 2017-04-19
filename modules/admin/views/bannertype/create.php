<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBannerType */

$this->title = 'Create Banner Type';
$this->params['breadcrumbs'][] = ['label' => 'Cms Banner Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$backUrl =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/bannertype/");
$this->params['backUrl'] = $backUrl;

?>
<div class="cms-banner-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
