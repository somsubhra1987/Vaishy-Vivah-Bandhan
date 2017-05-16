<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BodyType */

$this->title = 'Update Body Type: ' . $model->bodyType;
$this->params['breadcrumbs'][] = ['label' => 'Body Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bodyType];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="body-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
