<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserMaster */

$this->title = $model->userID;
$this->params['breadcrumbs'][] = ['label' => 'User Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['backUrl'] = Yii::$app->urlManager->createUrl(['admin/user']);
?>
<div class="user-master-view">

    
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
            'profileCreatedFor',
            'bodyType',
            'height',
            'age',
            'physicalStatus',
            'isActive',
        ],
    ]) ?>

</div>
