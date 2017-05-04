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
                'value'=> function ($data){ 
                                                                                                                                    
                    return ($data->adminVerifiedStatus)? "<input type='checkbox' name='adminVerifiedStatus' class='imageVerified-checkbox' checked='checked' value=$data->ID>" : "<input type='checkbox' name='adminVerifiedStatus' class='imageVerified-checkbox' value=$data->ID>";
                },
                'filter'=>['1'=>'Verified', '0'=>'Not Verified'],
                'format' => 'raw',
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<input type="hidden" id="uploadImageUrl" value="<?php echo Yii::$app->urlManager->createUrl('admin/uploadedimages/approved')?>"/>
<?php
$this->registerJs("
$('input[type=checkbox][name=adminVerifiedStatus]').change(function(e) {
    var url = $('#uploadImageUrl').val();
    var checkedStatus = 0;
    if($(this).prop('checked') == true){
        checkedStatus = 1;
    }
    var imageID= this.value;
    if(imageID){
        $.ajax({
            type:'post',
            data: {imageID:imageID, checkedStatus:checkedStatus},
            url:url,
            dataType:'json',
            success:function(response){
                if(response.status == 'success'){
                    alert(response.message);
                }
            },
            error:function() 
            {
                console.log('invalid request');
            }
        });
    }
});
");
?>