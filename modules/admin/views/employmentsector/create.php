<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\EmploymentSector */

$this->title = 'Create Employment Sector';
$this->params['breadcrumbs'][] = ['label' => 'Employment Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employment-sector-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
