<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserUploadedImages */

$this->title = 'Create User Uploaded Images';
$this->params['breadcrumbs'][] = ['label' => 'User Uploaded Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-uploaded-images-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
