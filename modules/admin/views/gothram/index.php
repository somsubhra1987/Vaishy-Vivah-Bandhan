<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\CustomHtml;
use app\lib\CustomFunctions;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\GothramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gothrams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gothram-index">

    <?=CustomHtml::getAddNewButton()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            CustomHtml::getEditActionIcon(),

            [
				'attribute' => 'religionID',
				'value' => function($data) {
					return CustomFunctions::getReligionAssoc()[$data->religionID];
				},
			],
            'gothram',

            CustomHtml::getDeleteActionIcon(),
        ],
    ]); ?>
</div>
