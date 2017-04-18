<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsPageType */

$this->title = 'Create PageType';
$this->params['breadcrumbs'][] = ['label' => 'Page Management', 'url' => ['page/index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['backUrl'] =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/page/");
?>
<div class="cms-page-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
