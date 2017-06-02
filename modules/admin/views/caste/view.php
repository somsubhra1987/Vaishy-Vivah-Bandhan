<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Caste */

$this->title = $model->caste;
$this->params['breadcrumbs'][] = ['label' => 'Castes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caste-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->casteID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->casteID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'casteID',
			'religionID',
            'caste',
        ],
    ]) ?>

</div>
