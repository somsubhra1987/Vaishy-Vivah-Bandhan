<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\CustomHtml;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\BodyTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Body Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="body-type-index">

    <?=CustomHtml::getAddNewButton()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            CustomHtml::getEditActionIcon(),
			
            'bodyType',

            CustomHtml::getDeleteActionIcon(),
        ],
    ]); ?>
</div>
