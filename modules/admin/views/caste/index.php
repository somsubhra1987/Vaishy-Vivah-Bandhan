<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\CustomHtml;
use app\lib\CustomFunctions;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CasteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Castes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caste-index">

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
            'caste',

            CustomHtml::getDeleteActionIcon(),
        ],
    ]); ?>
</div>
