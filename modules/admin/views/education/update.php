<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Education */

$this->title = 'Update Education: ' . $model->educationID;
$this->params['breadcrumbs'][] = ['label' => 'Educations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->educationID, 'url' => ['view', 'id' => $model->educationID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="education-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
