<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserMaster */

$this->title = 'Create User Master';
$this->params['breadcrumbs'][] = ['label' => 'User Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['backUrl'] = Yii::$app->urlManager->createUrl(['admin/user']);
?>
<div class="user-master-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
