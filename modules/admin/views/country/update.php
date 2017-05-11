<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Country */

$this->title = 'Update Country: ' . $model->countryID;
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->countryID, 'url' => ['view', 'id' => $model->countryID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="country-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
