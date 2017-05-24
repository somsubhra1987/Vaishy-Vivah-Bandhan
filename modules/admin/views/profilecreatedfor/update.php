<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProfilecreatedFor */

$this->title = 'Update Profilecreated For: ' . $model->createdFor;
$this->params['breadcrumbs'][] = ['label' => 'Profilecreated Fors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->createdFor, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profilecreated-for-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
