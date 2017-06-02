<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Gothram */

$this->title = 'Update Gothram: ' . $model->gothram;
$this->params['breadcrumbs'][] = ['label' => 'Gothrams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gothram];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gothram-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
