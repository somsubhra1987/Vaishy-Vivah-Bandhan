<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\userMaster */

$this->title = $model->userID;
$this->params['breadcrumbs'][] = ['label' => 'User Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-master-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->userID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->userID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'userID',
            'profileID',
            'firstName',
            'lastName',
            'gender',
            'dob',
            'email:email',
            'userPassword',
            'phoneNo',
            'address:ntext',
            'country',
            'state',
            'city',
            'subject',
            'personalInfo:ntext',
            'aboutFamily:ntext',
            'partnerPreference:ntext',
            'isActive',
        ],
    ]) ?>

</div>
