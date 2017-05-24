<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\CustomHtml;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProfilecreatedForSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profilecreated For';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profilecreated-for-index">

    <?=CustomHtml::getAddNewButton()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            CustomHtml::getEditActionIcon(),

            'createdFor',

            CustomHtml::getDeleteActionIcon(),
        ],
    ]); ?>
</div>
