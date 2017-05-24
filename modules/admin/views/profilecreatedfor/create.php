<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProfilecreatedFor */

$this->title = 'Create Profilecreated For';
$this->params['breadcrumbs'][] = ['label' => 'Profilecreated Fors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profilecreated-for-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
