<?php
use yii\helpers\Html;
?>
<!--footer-->
    
    <div class="footer-outer">
      <div class="container">
         <div class="footer-nav">
            <ul>
            <li><a href="index.html" style="padding-left:0px;">Home</a></li>
            <li><a href="about-us.html">About Us</a></li>
              <li><a href="service.html">Services</a></li>
              <li><a href="testiomonials.html">Testiomonials</a></li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
           
           <p>&copy; 2017 All rights reserved by <span class="yellow"> Vaishy Vivah Bandhan </span></p>
         </div>
         <div class="get-in-touch">Get In Touch With Us !
          <div class="social">
           <a href="https://www.facebook.com/Vaishy-Vivah-Bandhan-1461081057298345/" class="facebook"></a>
           <a href="#" class="twitter"></a>
           <a href="#" class="google"></a>
           <a href="#" class="you-tube"></a>
           <a href="#" class="rss"></a>
          </div>
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