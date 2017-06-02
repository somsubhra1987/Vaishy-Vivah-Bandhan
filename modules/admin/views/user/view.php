<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\lib\Core;
use app\lib\CustomFunctions;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserMaster */

$this->title = $model->firstName;
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
            [
				'attribute' => 'country',
				'value' => Core::getCountryAssoc()[$model->country],
			],
            [
				'attribute' => 'state',
				'value' => CustomFunctions::getStateAssoc($model->country)[$model->state],
			],
            'city',
            'subject',
            'personalInfo:ntext',
            'aboutFamily:ntext',
            'partnerPreference:ntext',
			[
				'attribute' => 'profileCreatedFor',
				'value' => CustomFunctions::getProfileCreatedForAssoc()[$model->profileCreatedFor],
			],
			[
				'attribute' => 'bodyType',
				'value' => CustomFunctions::getBodyTypeAssoc()[$model->bodyType],
			],
            'height',
            'age',
            'physicalStatus',
            [
				'attribute' => 'isActive',
				'value' => ($model->isActive) ? 'Yes' : 'No',
			],
        ],
    ]) ?>

</div>
