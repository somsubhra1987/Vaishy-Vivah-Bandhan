<?php
use yii\helpers\Html;
use app\lib\Core;
use app\lib\CustomHtml;
use yii\bootstrap\ActiveForm;

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
            <iframe src="<?php echo Core::getSettingsValue('map_link'); ?>" width="285" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
        <div class="bottom"></div>
      </div>
      <div class="contact-us">
        <h1><em>Quick Contact</em></h1>
        <div class="top"></div>
        <div class="middle">
          <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
          <p>Frist name
            <input type="text" name="ContactForm[firstName]" class="foam" required="required" placeholder="Enter your Frist name" />
          </p>
          <p>Last name
            <input type="text" name="ContactForm[lastName]" class="foam" required="required" placeholder="Enter your Last name" />
          </p>
          <p>Email
            <input type="text" name="ContactForm[email]" class="foam" required="required" placeholder="Enter your Email" />
          </p>
          <p>Query
            <textarea name="ContactForm[query]" class="quary" required="required" placeholder="Query"></textarea>
          </p>
          <p>
          	<?php echo Html::submitButton('submit', ['class' => 'submit']) ?>
            
            <?php echo CustomHtml::getFlashMsg(); ?>
          </p>
            
          <?php ActiveForm::end(); ?>
        </div>
        <div class="bottom"></div>
        <div class="last"> </div>
      </div>
      <div class="contact-us" style="margin-right:0px;">
        <h1><em>Get in Touch</em></h1>
        <div class="top"></div>
        <div class="middle">
          <p> <strong><?php echo Core::getSettingsValue('contact_person').','; ?></strong> <?php echo Core::getSettingsValue('designation').'. '.Core::getSettingsValue('address'); ?> <br />
            <br />
          </p>
          <p><?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/phone.png", ['alt' => '', 'align' => 'absmiddle']).' : &nbsp; '.Core::getSettingsValue('contact_no');?> </p>
          <p><?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/WhatsApp_Icon.png", ['alt' => '', 'align' => 'absmiddle']).' : &nbsp; '.Core::getSettingsValue('whatsapp_no');?> </p>
          <p> <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/mail.png", ['alt' => '', 'align' => 'absmiddle']).' : &nbsp; '.Core::getSettingsValue('email_ID');?> </p>
          <p>&nbsp;</p>
          <p> <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/contact.png", ['alt' => '', 'align' => 'absmiddle', 'width' => '100%']);?> </p>
        </div>
        <div class="bottom"></div>
        <div class="last"> </div>
      </div>
    </div>
  </div>
</div>