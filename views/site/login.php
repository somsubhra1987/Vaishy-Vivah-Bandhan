<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\lib\Core;
use app\lib\CustomFunctions;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$stateUrl = Yii::$app->getUrlManager()->createUrl(['site/stateagainstcountry']);
$forgotPasswordUrl = Yii::$app->getUrlManager()->createUrl(['/site/forgotpassword']);
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
            <div class="col-lg-12 white-bg">             
             <div class="col-lg-4" id="login-div">             
             <h2>Login</h2>
             <div class="line"></div>
             <?php $form = ActiveForm::begin([
             'id'=>'loginForm',
             'action'=>Yii::$app->urlManager->createUrl(['site/login']),
             'options' => ['class'=> 'comments-form contact-form']
             ])?>
             <div id="login-message"><?php echo Yii::$app->session->getFlash('success'); ?></div>
                <div class="form-group">                        
                  <input type="text" class="form-control" placeholder="Your Email" name="LoginForm[username]" id="loginform-username">
                </div>
                <div class="form-group">                        
                  <input type="password" class="form-control" placeholder="password" name="LoginForm[password]" id="loginform-password">
                </div>                     
                <div class="form-group">                        
                  <a href="javascript:void(0);" class="gray-text" onclick="showForgotPasswordDiv();">Forgot Password </a> 
                </div>
                <?php echo Html::submitButton('Login', ['class' => 'comment-btn', 'id'=>'login-button']) ?>
                <?php ActiveForm::end(); ?>
                
                <div id="responseRegisterMessage" style="margin-top:30px;"></div>
            </div>  
    
    		<div class="col-lg-4 hidden" id="forget-password-div">             
             	<h2>Forgot Password</h2>
             	<div class="line"></div>
             
             	<div id="forgot-password-message"></div>
                <div class="form-group">                        
                  <input type="email" class="form-control" placeholder="Enter you Email ID" name="email_id" id="email_id">
                </div>
                <?= Html::button('Submit', ['class' => 'comment-btn', 'onclick' => 'forgotPassword();']) ?>
                
                <div id="responseForgotPasswordMessage" style="margin-top:30px;"></div>
            </div>
    
            <div class="col-lg-8">
             
             <h2>New User Register</h2>
             <div class="line"></div>
            <?php $form = ActiveForm::begin([
                      'id'=>'registerForm',
                      'action'=> Yii::$app->urlManager->createUrl(['site/register']),
                      'options' => [
                                    'class'=> 'comments-form contact-form'
                                    ]
                        ])
                        ?>
                    
                    <div class="form-group">                        
                      <input type="text" class="form-control" placeholder="Your Name" name="UserMaster[firstName]">
                    </div>
                    <div class="form-group">                        
                      <input type="email" class="form-control" placeholder="Email" name="UserMaster[email]">
                    </div>
                     <div class="form-group">                        
                      <input type="text" class="form-control" placeholder="Subject" name="UserMaster[subject]">
                    </div>
                     <div class="form-group">                        
                      <input type="text" class="form-control" placeholder="Phone" name="UserMaster[phoneNo]">
                    </div>
                    
                     <div class="form-group">                        
                      <textarea class="form-control" placeholder="Address" name="UserMaster[address]" rows="2"></textarea>
                    </div>
                    
                    <div class="form-group">
                      <select class="form-control" name="UserMaster[country]" onchange="getState(this.value);">
                        <option value="0">--Select Country--</option>
                        <?php foreach(Core::getCountryAssoc() as $key => $value){ ?>
                          <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php } ?>
                      </select>
                    </div>
    
                    <div class="form-group">
                      <select class="form-control" name="UserMaster[state]" id="usermaster-state">
                        <option value="0">--Select State--</option>
                        
                      </select>
                    </div>
    
                     <div class="form-group">                        
                      <input type="text" class="form-control" placeholder="City" name="UserMaster[city]">
                    </div>
    
                     <div class="form-group">                        
                      <input type="text" class="form-control" placeholder="D.O.B (YY-mm-dd)" name="UserMaster[dob]">
                    </div>
                    <?= Html::submitButton('Register', ['class' => 'comment-btn', 'id'=>'register-button']) ?>                   
                  <?php ActiveForm::end(); ?>
                </div>  
             </div>    
        </div>
      </div>
    </div> 
   </section>
  <!-- End Feature -->
  <?php $this->registerJsFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/js/loginRegister.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>

  <script type="text/javascript">
  function getState(countryID)
  {
    $.ajax({
      method:'GET',
      dataType: 'json',
      url:'<?php echo $stateUrl; ?>',
      data:{countryID:countryID},
      beforeSend:function(){
        $("#usermaster-state").html('<option value="0">--Select State--</options>');
      },
      success:function(response) {
        $.each(response, function(i, value) {
          $('#usermaster-state').append($('<option>').text(value).attr('value', i));
        });
      }
    });
  }
  
  function showForgotPasswordDiv()
  {
  	$("#login-div").addClass("hidden");
	$("#forget-password-div").removeClass("hidden");
	$("#email_id").focus();
  }
  
  function forgotPassword()
  {
  	var emailId = $("#email_id").val().trim();
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(emailId))
	{
		$("#responseForgotPasswordMessage").html('<span class="text-red">Please wait...</span>');
		$.ajax({
		  method:'GET',
		  dataType: 'json',
		  url:'<?php echo $forgotPasswordUrl; ?>',
		  data:{emailId:emailId},
		  success:function(response) {
			if(response.status == 'error')
			{
				$("#responseForgotPasswordMessage").html('<span class="text-red">'+response.message+'</span>');
			}
			else
			{
				$("#responseForgotPasswordMessage").html('<span class="text-green">'+response.message+'</span>');
			}
		  }
		});
	}
	else
	{
		$("#responseForgotPasswordMessage").html('<span class="text-red">Invalid Email</span>');
		$("#email_id").focus();
	}
  }
</script>