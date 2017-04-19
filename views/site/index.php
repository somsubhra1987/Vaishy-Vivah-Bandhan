<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<!--mid-container-->
     <div class="mid-container">
      <div class="call-back">
        <div class="container">
              <div class="search-area-box">
              <h2><?= Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/user-1.png", ['alt' => '', 'align'=>'absmiddle'])?> Creat Your Profile</h2>
             <div class="search-area ">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
            <?php echo $form->errorSummary($model) ?>
            <?php echo Yii::$app->session->getFlash('success') ?>
            <p>

            <span> Enter Your Name</span> <br />
             <input type="text" name="UserMaster[firstName]" class="search" placeholder="Enter your  Name.." />
            </p>
             <p>
            <span> Enter Your Email Id</span> <br />
             <input type="text" name="UserMaster[email]" class="search" placeholder="Enter your Email.." />
            </p>
             <p>
            <span> Upload image </span> <br />
             <input type="file" name="UserMaster[fileName]" class="search" placeholder="Enter your contact no.." />
             </p>
             <?= Html::submitButton('submit', ['class' => 'submit']) ?>
            
             <?php ActiveForm::end(); ?>
             <p><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/icon-colsi.png" style="position:absolute; right:-40px;"/></p>
            <div class="clear"></div>
          </div> 
          </div>
           
          <div class="right">
           <span> <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/chat--.png"  align="absmiddle"/> &nbsp;  <strong class="click-hare"> 
           Presented By : </strong> Shri Kanyakub Vaishy Nabayubak Sangh Kolkat West Bengal
          </span>
           </div>
        </div>
      </div>
      
      <div class="service-area">
        <div class="container">
          <div class="service">
            <h1>Welcome to Vaishyvivah  </h1>
            <p><span class="orange">Marriage </span>
            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae .<br />
<br />

 ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.<br />
<br />
 

Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur. Click Here.. <a href="about-us.html" class="click-hare">Click Here..</a></p>
          </div>
          <div class="service">
            <h1>Most Trusted &amp; Successful</h1>
            <ul>
              <li>100% mobile verified profiles.</li>
              <li>Featured in the Limca Book of Records for the highest number of documented marriages online.</li>
              <li>World'd Best Matches  And Maximam Responses.</li>
              <li>Millions of profiles to choose from.</li>
              <li>Join 1 Million Members with Photos.</li>
            </ul>
          </div>
          <div class="service" style=" margin-right:0px;">
            <h1>Vaishyvivah   Success  Couples</h1>
            
            <div class="news">
             <div class="news-left">
             <?= Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/couple-1.jpg", ['alt' => ''])?>
             </div>
             <div class="news-right">
              <h3>Sakshi Gupta And Kailash relan <span class="orange">12th April 2012</span> in Delhi.</h3>
              <div class="clear"></div>
              <p>While I was in Mumbai and Pavini was in Delhi, we exchanged ..<br />
                 <a href="service.html" class="view-all"><strong>[View More]</strong></a></p>
             </div>
            </div>
            
            <div class="news" style="border-bottom:none;">
             <div class="news-left"><?= Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/couple-2.jpg", ['alt' => ''])?></div>
             <div class="news-right">
              <h3>Sakshi Gupta And Kailash relan <span class="orange">12th April 2012</span> in Delhi.</h3>
              <div class="clear"></div>
              <p>While I was in Mumbai and Pavini was in Delhi, we exchanged ....<br />
                 <a href="service.html" class="view-all"><strong>[View More]</strong></a></p>
             </div>
            </div>
            <p></p>
          </div>
        </div>
      </div>
     </div>

<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/js/jquery.flexslider-min.js', ['depends' => [yii\web\JqueryAsset::className()]]);?>
<?php echo $this->registerCssFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/css/flexslider.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);?>
<!-- Hook up the FlexSlider -->
<?php
$this->registerJs("
$(window).load(function() {
    $('.flexslider').flexslider();
});
");