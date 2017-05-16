<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\State */

$this->title = 'Update State: ' . $model->state;
$this->params['breadcrumbs'][] = ['label' => 'States', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->state];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="state-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
