<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserMaster */

$this->title = 'Update User Master: ' . $model->userID;
$this->params['breadcrumbs'][] = ['label' => 'User Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->userID, 'url' => ['view', 'id' => $model->userID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
