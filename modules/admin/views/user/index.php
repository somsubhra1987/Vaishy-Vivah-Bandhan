<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\CustomHtml;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-master-index">

   <?=CustomHtml::getAddNewButton()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            CustomHtml::getEditActionIcon(),
            //'userID',
            'profileID',
            'firstName',
            //'lastName',
            'gender',
            // 'dob',
             'email:email',
            // 'userPassword',
            // 'phoneNo',
            // 'address:ntext',
            // 'country',
            // 'state',
            // 'city',
            // 'subject',
            // 'personalInfo:ntext',
            // 'aboutFamily:ntext',
            // 'partnerPreference:ntext',
            // 'profileCreatedFor',
            // 'bodyType',
            // 'height',
            // 'age',
            // 'physicalStatus',
            // 'isActive',
             CustomHtml::getDeleteActionIcon(),
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
