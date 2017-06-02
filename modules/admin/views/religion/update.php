<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Religion */

$this->title = 'Update Religion: ' . $model->religion;
$this->params['breadcrumbs'][] = ['label' => 'Religions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->religion];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="religion-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
