<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\CustomHtml;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ReligionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Religions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="religion-index">

    <?=CustomHtml::getAddNewButton()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            CustomHtml::getEditActionIcon(),

            'religion',

            CustomHtml::getDeleteActionIcon(),
        ],
    ]); ?>
</div>
