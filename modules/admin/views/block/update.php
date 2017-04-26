<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBlock */

$this->title = 'Update Block: ' . ' ' . $model->blockID;
$this->params['breadcrumbs'][] = ['label' => 'Block Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';

$backUrl =  Yii::$app->urlManager->createAbsoluteUrl("admin/block");
$this->params['backUrl'] = $backUrl;
?>

<div class="cms-block-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
