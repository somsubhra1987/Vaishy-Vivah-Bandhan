<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Caste */

$this->title = 'Create Caste';
$this->params['breadcrumbs'][] = ['label' => 'Castes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caste-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
