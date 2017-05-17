<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Occupation */

$this->title = 'Update Occupation: ' . $model->occupation;
$this->params['breadcrumbs'][] = ['label' => 'Occupations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->occupation];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="occupation-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
