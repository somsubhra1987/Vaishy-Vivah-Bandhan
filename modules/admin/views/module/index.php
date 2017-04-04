<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AppModuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Module Management';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-module-index">

    <p>
        <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success btn-position-right']) ?>
    </p>
    
	<?php Pjax::begin(['id'=> 'module-grid',])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'moduleCode',
            'moduleName',
            [
            	'value'=>function($data){
	                return ($data->active)?'Yes':'No';
	                },
            	'filter'=>Html::activedropDownList($searchModel, 'active',[
                 ''=>'All',
                     '1'=>'Yes',
                     '0'=>'No',
                ],                
                [
                'class'=>'form-control',
                ]),  
            ],

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{update}{delete}'],
        ],
    ]); ?>
	<?php Pjax::end()?>
</div>
