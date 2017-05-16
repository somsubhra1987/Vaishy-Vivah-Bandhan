<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\CustomHtml;
use app\lib\Core;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\StateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'States';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-index">

    <?=CustomHtml::getAddNewButton()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            CustomHtml::getEditActionIcon(),

            'state',
            [
				'attribute' => 'countryID',
				'value' => function($data) {
					return Core::getCountryName($data->countryID);
				}
			],

            CustomHtml::getDeleteActionIcon(),
        ],
    ]); ?>
</div>
