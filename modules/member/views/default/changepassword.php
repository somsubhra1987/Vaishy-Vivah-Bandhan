<?php

use yii\helpers\Html;
use app\lib\Core;
use app\lib\CustomFunctions;
use yii\bootstrap\ActiveForm;
?>
<style type="text/css">
.text-red{ color:#dd4b39 !important; }
.text-green{ color:#00a65a !important; }
</style>
<!-- Start Feature -->
<section id="feature">
    <div class="container">

        <div class="space top-space"></div>

        <div class="row">
            <div class="col-md-12">

                <div class="space"></div>
                <div class="col-lg-9 white-bg">
                    <div class="col-md-7">
           
                        <h2>Change Password</h2>
                         <div class="line"></div>
                        <?php $form = ActiveForm::begin([
                                  'id'=>'changePasswordForm',
                                  'options' => [
                                        'class'=> 'comments-form contact-form'
                                    ]
                               ]);
                        ?>
                                
                        <div class="form-group">                        
                          <input type="password" class="form-control" placeholder="New Password" name="UserMaster[newPassword]" autofocus="autofocus" />
                        </div>
                        <div class="form-group">                        
                          <input type="password" class="form-control" placeholder="Confirm Password" name="UserMaster[confirmPassword]" />
                        </div>
                         
                        <?= Html::submitButton('Change Password', ['class' => 'comment-btn']) ?>                   
                        <?php ActiveForm::end(); ?>
                    </div>
                    
                    <div class="col-md-5">
                    	<div id="login-message" style="margin-top:30px;">
                            <?php echo Yii::$app->session->getFlash('error'); ?>
                        </div>
                    </div>
                </div>
           
                <div class="col-md-3 white-bg">
                    <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images//300x600.jpg" class="img-thumbnail" width="100%">
                    <div class="space"></div>
                    <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images//300x600-1.jpg" class="img-thumbnail" width="100%"> 
                    <div class="space"></div>
                    <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images//300x600-2.png" class="img-thumbnail" width="100%">
                </div>      
       
            </div>
        </div><!-- Row-->        
    </div><!--container-->
</section><!--section-->
<!-- End Feature -->