<?php
use yii\helpers\Html;
use app\lib\Core;
?>
<div class="making-area div-n">
  <div class="container">
    <ul>
      <li><a href="#">matrimonial services</a></li>
      <li><a href="#">MATCH MAKING SERVICES</a></li>
      <li><a href="#">Matrimonial Profile</a></li>
      <li style="background:none; margin-right:0px;"><a href="#" style="padding:0px;">Marriage Bureau </a></li>
    </ul>
  </div>
</div>
<!--footer-->
<div class="footer-outer">
  <div class="container">
    <div class="footer-nav">
    	<a href="<?php echo Yii::$app->homeUrl;?>" style="padding-left:0px;">Home</a>    |  
        <?php echo Html::a('About Us',['site/about']);?>   |  
        <?php echo Html::a('Services',['site/service']);?>   |    
        <?php echo Html::a('Testiomonials',['site/testimonial']);?>  | 
        <?php echo Html::a('Contact',['site/contact']);?>
      
      	<p>&copy; <?php echo date('Y'); ?> All rights reserved by <span class="yellow"> Vaishy Vivah Bandhan </span></p>
    </div>
    <div class="get-in-touch">Get In Touch With Us !
      <div class="social"> <a href="<?php echo Core::getSettingsValue('facebook_link'); ?>" target="_blank" class="facebook"></a> <a href="<?php echo Core::getSettingsValue('twitter_link'); ?>" target="_blank" class="twitter"></a> <a href="<?php echo Core::getSettingsValue('gplus_link'); ?>" target="_blank" class="google"></a> <a href="<?php echo Core::getSettingsValue('youtube_link'); ?>" target="_blank" class="you-tube"></a> <a href="<?php echo Core::getSettingsValue('rss_link'); ?>" target="_blank" class="rss"></a> </div>
    </div>
  </div>
</div>
<div class="clear"></div>
</div>
<!-- Start: Modal -->
<div id="commonModal" class="modal fade" tabindex="-1" role="dialog"></div>
<!--End: Modal -->
<?php 
  $this->registerJsFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/js/modal.js', ['depends' => [yii\web\JqueryAsset::className()]]); 
  ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>