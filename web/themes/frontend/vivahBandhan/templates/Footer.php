<?php
use yii\helpers\Html;
?>
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
<!--footer-->
<div class="footer-outer">
  <div class="container">
    <div class="footer-nav">
      <ul>
        <li><a href="<?php echo Yii::$app->homeUrl;?>" style="padding-left:0px;">Home</a></li>
        <li><?php echo Html::a('About Us',['site/about']);?></li>
        <li><?php echo Html::a('Services',['site/service']);?></li>
        <li><?php echo Html::a('Testiomonials',['site/testimonial']);?></li>
        <li><?php echo Html::a('Contact',['site/contact']);?></li>
      </ul>
      <p>&copy; 2017 All rights reserved by <span class="yellow"> Vaishy Vivah Bandhan </span></p>
    </div>
    <div class="get-in-touch">Get In Touch With Us !
      <div class="social"> <a href="https://www.facebook.com/Vaishy-Vivah-Bandhan-1461081057298345/" class="facebook"></a> <a href="#" class="twitter"></a> <a href="#" class="google"></a> <a href="#" class="you-tube"></a> <a href="#" class="rss"></a> </div>
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