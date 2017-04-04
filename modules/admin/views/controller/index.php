<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AppControllerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'App Controllers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-controller-index">

    <p>
        <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success btn-position-right']) ?>
    </p>
	<?php Pjax::begin(['id'=> 'controller-grid', 'enablePushState'=>false])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'controllerID',            
            [
            'attribute'=>'moduleCode',
            'label'=>'Module Name',
            ],            
            'controllerName',           
            [
            	'attribute'=>'active',
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
