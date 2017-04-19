<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\lib\core\RpHtml;

//use app\modules\admin\cms\models\CmsBannerTypeSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\cms\models\CmsBannerTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banner Type List';
$this->params['breadcrumbs'][] = 'Banner Type Management';
?>
<div class="cms-banner-type-index">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php echo RpHtml::getFlash();?>
    
    <p>
        <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success btn-position-right']) ?>
    </p>
	
    <?php Pjax::begin(['id' => 'cms-block-grid','enablePushState' => FALSE])?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
			'title',
            'bannerTypeCode',            
            ['class' => 'yii\grid\ActionColumn', 
            'template'=>'{update}{delete}',
            ],
        ],
    ]); ?>
    
	<?php Pjax::end();?>
</div>
