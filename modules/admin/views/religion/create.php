<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Religion */

$this->title = 'Create Religion';
$this->params['breadcrumbs'][] = ['label' => 'Religions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="religion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
