<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\CustomHtml;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\EmploymentSectorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employment Sectors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employment-sector-index">

    <?=CustomHtml::getAddNewButton()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            CustomHtml::getEditActionIcon(),

            'sectorName',

            CustomHtml::getDeleteActionIcon(),
        ],
    ]); ?>
</div>
