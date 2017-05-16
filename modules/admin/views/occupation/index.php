<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\CustomHtml;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OccupationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Occupations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupation-index">
    <?=CustomHtml::getAddNewButton()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            CustomHtml::getEditActionIcon(),

            'occupation',

            CustomHtml::getDeleteActionIcon(),
        ],
    ]); ?>
</div>
