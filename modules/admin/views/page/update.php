<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsPage */

$this->title = 'Update Page: ' . ' ' . $model->pageID;
$this->params['breadcrumbs'][] = ['label' => 'Page Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
$this->params['backUrl'] =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/page/");

?>
<div class="cms-page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
