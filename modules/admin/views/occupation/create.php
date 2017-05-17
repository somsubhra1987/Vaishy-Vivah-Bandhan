<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Occupation */

$this->title = 'Create Occupation';
$this->params['breadcrumbs'][] = ['label' => 'Occupations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupation-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
