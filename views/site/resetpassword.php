<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\lib\Core;
use app\lib\CustomFunctions;

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;

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
         <div class="space top-space"></div>         
            <div class="col-lg-12 white-bg" style="height:69vh;">             
             <div class="col-lg-3">
             	
            </div>
    
            <div class="col-lg-6">
             
             <h2>Reset Password</h2>
             <div class="line"></div>
            <?php $form = ActiveForm::begin([
                      'id'=>'resetPasswordForm',
                      'options' => [
							'class'=> 'comments-form contact-form'
						]
                   ]);
				   if($userStatus == 0)
				   {
            ?>
            <h3 class="text-red">This Link has been Expired !!</h3>
            <?php
				   }
				   else
				   {
			?>
                    
                    <div class="form-group">                        
                      <input type="password" class="form-control" placeholder="New Password" name="UserMaster[newPassword]" autofocus="autofocus" />
                    </div>
                    <div class="form-group">                        
                      <input type="password" class="form-control" placeholder="Confirm Password" name="UserMaster[confirmPassword]" />
                    </div>
                     
                    <?= Html::submitButton('Reset Password', ['class' => 'comment-btn']) ?>                   
                  <?php ActiveForm::end(); ?>
                  
                  <div id="login-message" style="margin-top:30px;">
                	<?php echo Yii::$app->session->getFlash('error'); ?>
                  </div>
                  <?php } ?>
                </div>
                
                <div class="col-lg-3" id="login-div">
             
            	</div>
            
             </div>   
        </div>
      </div>
    </div> 
   </section>
  <!-- End Feature -->