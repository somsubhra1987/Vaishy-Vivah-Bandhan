<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Gothram */

$this->title = 'Create Gothram';
$this->params['breadcrumbs'][] = ['label' => 'Gothrams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gothram-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
