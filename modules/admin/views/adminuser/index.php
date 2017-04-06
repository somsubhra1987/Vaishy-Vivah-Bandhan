<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AppAdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-admin-index">
    
    <?php if (Yii::$app->session->hasFlash('flashSuccess')): ?>
	<div class="alert alert-success">
	    <?php echo Yii::$app->session->getFlash('flashSuccess') ?>
	</div>
	<?php endif; ?>
	<?php if (Yii::$app->session->hasFlash('flashDelete')): ?>
	<div class="alert alert-success">
	    <?php echo Yii::$app->session->getFlash('flashDelete') ?>
	</div>
	<?php endif; ?>
	
    <p>
        <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success btn-position-right']) ?>
    </p>
	<?php Pjax::begin(['id' => 'adminuserlist-grid'])?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'adminID',            
            [
            	'attribute'=>'username',
            	'format'=>'raw',
            	'value'=>function ($data) {	            	
	            	$linkUrl = Yii::$app->urlManager->createUrl(['admin/adminuser/view','id'=>$data->adminID]);	            	
			        return Html::a(Html::encode($data->username),$linkUrl);
			    },
            ],
            'adminGroupName',            
            //'password',
            'email:email',
            'firstName',
            'lastName',
            // 'dateTimeCreated',
            // 'address',
            // 'countryCode',
            // 'state',
            // 'city',
            // 'zip',
            // 'phone',
            // 'mobile',
            // 'signature:ntext',
            // 'active',

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{update}'],
        ],
    ]); ?>
	<?php Pjax::end();?>
</div>
