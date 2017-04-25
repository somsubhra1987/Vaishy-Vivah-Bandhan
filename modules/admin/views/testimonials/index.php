<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\CustomHtml;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TestimonialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Testimonials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testimonials-index">
	<?php echo CustomHtml::getFlash();?>
    
    <p>
        <?= Html::a('Create Testimonials', ['create'], ['class' => 'btn btn-success btn-position-right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'testimonialsID',
            'groomName',
            'groomShortDescription:ntext',
            'brideName',
            'brideShortDescription:ntext',
            // 'coupleImage',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
