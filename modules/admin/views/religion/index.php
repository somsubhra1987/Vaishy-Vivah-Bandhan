<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ReligionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Religions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="religion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Religion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'religionID',
            'religion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
