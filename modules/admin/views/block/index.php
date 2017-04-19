<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\admin\cms\models\CmsBlockSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\cms\models\CmsBlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Block List';
$this->params['breadcrumbs'][] = 'Block Management';
?>
<div class="cms-block-index">
    
    <?php if (Yii::$app->session->hasFlash('success')): ?>
	<div class="alert alert-success">
	    <?php echo Yii::$app->session->getFlash('success') ?>
	</div>
	<?php endif; ?>
	
    <p>
        <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success btn-position-right']) ?>
    </p>
    
	<?php Pjax::begin(['id' => 'cms-block-grid'])?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'blockCode',
            'title',

            ['class' => 'yii\grid\ActionColumn',
             'template'=>'{update}{delete}',
            ],
        ],
    ]); ?>
    
	<?php Pjax::end();?>
</div>
