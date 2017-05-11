<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BodyType */

$this->title = 'Update Body Type: ' . $model->bodyTypeID;
$this->params['breadcrumbs'][] = ['label' => 'Body Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bodyTypeID, 'url' => ['view', 'id' => $model->bodyTypeID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="body-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
