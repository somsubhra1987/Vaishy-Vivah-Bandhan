<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\lib\core\App;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AppAdmin */

$this->title = 'View Admin User : '.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['backUrl'] =  Yii::$app->urlManager->createUrl("admin/adminuser");
?>
<div class="app-admin-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'adminID',
            'adminGroupID',
            'username',
            //'password',
            'email:email',
            'firstName',
            'lastName',
            'dateTimeCreated',
            'address',            
            [
            	'attribute'=>'countryCode',
            	'value'=> App::getCountryName($model->countryCode),
           	],
            'state',
            'city',
            'zip',
            'phone',
            'mobile',
            'signature:ntext',
            [
            'attribute'=>'active',
            'format'=>'raw',
            'value'=> ($model->active)?'Yes':'NO',
            ],
            
        ],
    ]) ?>

</div>
