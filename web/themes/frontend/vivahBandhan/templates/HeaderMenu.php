<?php
use yii\helpers\Html;
?>
<div class="header-outer service-col1">
	<div class="service-bg heaight">
      <div class="container">
       <div class="breadcumb">
         <ul>
           <li><a href="<?php echo Yii::$app->homeUrl;?>">Home</a></li>
           <li>/</li>
           <li><?php echo $this->title; ?></li>
         </ul>
         </div>
         
         <h1><?php echo $this->title; ?></h1>
       </div>
    </div>
    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="<?php echo Yii::$app->homeUrl;?>">
                <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/logo.png", ['alt' => '']);?>
                </a>
            </div>
            <div class="contact">
                <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/WhatsApp_Icon.png", ['alt' => '', 'align'=>'absmiddle'])?> : 9903809974
                <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/phone.png", ['alt' => '', 'align'=>'absmiddle']);?> : +91 9674535521
            </div>
            <div class="navigation">
                <ul>
                    <li><a href="<?php echo Yii::$app->homeUrl;?>" class="active">home</a>
                    </li>
                    <li><a href="about-us.html">About Us</a>
                    </li>
                    <li><a href="service.html">Services</a>
                    </li>
                    <li><a href="testiomonials.html">Testiomonials</a>
                    </li>
                    <li><?php echo Html::a('Contact',['site/contact']);?></li>
                    <li style="background:none;"><?php echo Html::a('login',['site/login']);?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div> 