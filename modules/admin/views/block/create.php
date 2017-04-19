<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBlock */

$this->title = 'Create Block';
$this->params['breadcrumbs'][] = ['label' => 'Block Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$backUrl =  Yii::$app->urlManager->createAbsoluteUrl("admin/cms/block/");
$this->params['backUrl'] = $backUrl;
?>

<div class="cms-block-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
