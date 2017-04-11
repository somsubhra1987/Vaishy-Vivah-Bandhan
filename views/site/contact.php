<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact Us';
?>
    <!---------mid-container--------------->
     
     
     <div class="clear"></div> 
     <div class="mid-container">
       <div class="testimonial-area">
        <div class="container">
        
          <div class="contact-us">
           <h1><em>Vaishy Vivah Map</em></h1>
            <div class="top"></div>
            <div class="middle">
            <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.632328929365!2d88.35216051442004!3d22.592850685172387!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0277c8b746ce97%3A0x7c435c1d317521fd!2s79%2C+Nimtala+Ghat+St%2C+Jorabagan%2C+Kolkata%2C+West+Bengal+700006!5e0!3m2!1sen!2sin!4v1487812228842" width="285" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
            </div>
            <div class="bottom"></div>
            
          </div>
          
          
          <div class="contact-us">
            <h1><em>Quick Contact</em></h1>
            <div class="top"></div>
            <div class="middle">
             <p>Frist name
             <input type="text" class="foam" placeholder="Enter your Frist name" />
             </p>
             <p>Last name
             <input type="text" class="foam" placeholder="Enter your Last name" />
             </p>
             <p>Email
             <input type="text" class="foam" placeholder="Enter your Email" />
             </p>
             <p>Quary
               <textarea class="quary" placeholder="Quary"></textarea>
             </p>
              
             <p> <input type="button" class="submit" value="submit" /></p>
            </div>
            <div class="bottom"></div>
            <div class="last">
            </div>
          </div>
          
          
          <div class="contact-us" style="margin-right:0px;">
           <h1><em>Get in Touch</em></h1>
            <div class="top"></div>
            <div class="middle">
            <p>
            <strong>Sri Ajay Shaw,</strong> Vice Properties Advisor. 79/c Nimtalla Ghat Street, Kolkata-700006, <br /> <br /> 
             </p>
            

                
                <p><?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/phone.png", ['alt' => '', 'align' => 'absmiddle']);?> : &nbsp;  +91   9674535521 </p> 
                <p><?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/WhatsApp_Icon.png", ['alt' => '', 'align' => 'absmiddle']);?> :   &nbsp; 9903809974 </p> 
                <p> <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/mail.png", ['alt' => '', 'align' => 'absmiddle']);?> :  &nbsp; ajayshaw1959@gmail.com </p> 
                <p>&nbsp;</p>
                <p> <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/contact.png", ['alt' => '', 'align' => 'absmiddle', 'width' => '100%']);?> </p> 
                
            </div>
            <div class="bottom"></div>
            <div class="last">
            </div>
          </div>
          
          
          

        </div>
      </div>
      
      
      
      
      <div class="making-area">
        <div class=" container">
          <ul>
            <li><a href="#">matrimonial services</a></li>
            <li><a href="#">MATCH MAKING SERVICES</a></li>
            <li><a href="#">Matrimonial Profile</a></li>
            <li style="background:none; margin-right:0px;"><a href="#" style="padding:0px;">Marriage Bureau </a></li>
          </ul>
        </div>
      </div>
     </div>
