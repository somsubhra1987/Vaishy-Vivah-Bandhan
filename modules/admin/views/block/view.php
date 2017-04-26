<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\cms\models\CmsBlock */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cms Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$backUrl =  Yii::$app->urlManager->createAbsoluteUrl("admin/block");
$backLink = "<a href=\"$backUrl\">Back</a>";
?>

<div class="back-to-list"><?php echo $backLink ?></div>

<div class="cms-block-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
     	<?= Html::a('Delete', ['delete', 'id' => $model->blockID], [
            'class' => 'btn btn-danger btn-position-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Update', ['update', 'id' => $model->blockID], ['class' => 'btn btn-primary btn-position-right']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'blockID',
            'blockCode',
            'title',
            [                      
	            'label' => 'content',
	            'value' => $model->content,
	            'format' => 'raw',
	         ],
        ],
    ]) ?>

</div>
