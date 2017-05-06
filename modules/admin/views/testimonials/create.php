<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Testimonials */

$this->title = 'Create Testimonials';
$this->params['breadcrumbs'][] = ['label' => 'Testimonials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testimonials-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
