<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsPage */

$this->title = 'Create Page';
$this->params['breadcrumbs'][] = ['label' => 'Page Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['backUrl'] = Yii::$app->urlManager->createAbsoluteUrl("admin/cms/page/");
?>

<div class="cms-page-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
