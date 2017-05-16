<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\EmploymentSector */

$this->title = 'Update Employment Sector: ' . $model->sectorName;
$this->params['breadcrumbs'][] = ['label' => 'Employment Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sectorName];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employment-sector-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
