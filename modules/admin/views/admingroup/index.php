<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AppAdminGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Group';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-admin-group-index">
    
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
<?php Pjax::begin(['id' => 'admingrouplist-grid'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'adminGroupID',
            'title',
            'adminGroupCode',            
            //'super',
            [
            	'attribute'=>'permission',
            	'format'=>'raw',
            	'value'=>function($data){
	            	$linkUrl = Yii::$app->urlManager->createUrl(['admin/permission/update','id'=>$data->adminGroupID]);	
	            	return HTML::a(HTML::encode('Permission'),$linkUrl);
	            }
            ],
            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{update}{delete}'],
        ],
    ]); ?>
<?php Pjax::end();?>
</div>
