<?php
use yii\helpers\Html;
use app\lib\Core;

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
          <p>Frist name
            <input type="text" class="foam" placeholder="Enter your Frist name" />
          </p>
          <p>Last name
            <input type="text" class="foam" placeholder="Enter your Last name" />
          </p>
          <p>Email
            <input type="text" class="foam" placeholder="Enter your Email" />
          </p>
          <p>Query
            <textarea class="quary" placeholder="Query"></textarea>
          </p>
          <p>
            <input type="button" class="submit" value="submit" />
          </p>
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