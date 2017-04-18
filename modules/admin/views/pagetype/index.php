<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\cms\models\CmsPageTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Page Type List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-page-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success btn-position-right']) ?>
    </p>
<?php Pjax::begin(['id' => 'pagetype-grid'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pageTypeID',
            'pageTypeCode',
            'title',
            'folderName',
            'listingOrder',
            // 'showInSitemap',

            ['class' => 'yii\grid\ActionColumn',
             'template'    => '{update}{delete}',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
