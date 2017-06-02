<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Caste */

$this->title = 'Update Caste: ' . $model->caste;
$this->params['breadcrumbs'][] = ['label' => 'Castes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->caste];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="caste-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
