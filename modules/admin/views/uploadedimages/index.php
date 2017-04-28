<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\CustomHtml;
use app\lib\Core;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserUploadedImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Uploaded Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-uploaded-images-index">

<?php //CustomHtml::getAddNewButton()?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'ID',
        [
            'attribute'=>'fileName',
            'value'=>function($data){
                $uploadedPath = Core::getUploadedUrl();
                $uploadedPath .=  "/".$data->refTable."/";                
                $uploadedPath .= "thumb/thumb_";                
                $uploadedPath .= $data->fileName;
                return Html::img($uploadedPath, ['alt'=>'', 'width'=>100,]);
            },
            'format' => 'raw',
        ],
            //'refID',
            //'refTable',
            //'adminVerifiedStatus',
            // 'showInDp',
            [
                'attribute'=> 'adminVerifiedStatus',
                'value'=> function($data){
                    return ($data->adminVerifiedStatus >0)? 'Verified':'Not Verified';
                },
                'filter'=>['1'=>'Verified', '0'=>'Not Verified'],
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
