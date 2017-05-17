<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Country */

$this->title = 'Update Country: ' . $model->country;
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->country];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="country-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
