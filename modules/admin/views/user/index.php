<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
