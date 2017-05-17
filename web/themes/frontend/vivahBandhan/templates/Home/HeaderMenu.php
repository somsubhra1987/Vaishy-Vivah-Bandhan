<?php
use yii\helpers\Html;
use app\lib\Cms;
use app\lib\Core;
?>
<div class="header-outer index-heaight">
    <div class="banner-area">
        <div class="flexslider">
            <ul class="slides">
                <?php
                $bannerList = Cms::getBannerByRegionCode('homePageHeaderBanner');
                foreach($bannerList as $key=>$data)
                {
                    ?>
                <li>
                    <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/datafiles/cms_banner/main/main_".$data['image'], ['alt' => "$data[title]"])?>
                </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="<?php echo Yii::$app->homeUrl;?>">
                <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/logo.png", ['alt' => ''])?>                
                </a>
            </div>
            <div class="contact">
                <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/WhatsApp_Icon.png", ['alt' => '', 'align'=>'absmiddle']).' : '.Core::getSettingsValue('whatsapp_no'); ?>
                <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/phone.png", ['alt' => '', 'align'=>'absmiddle'])?> : +91 9674535521
            </div>
            <div class="navigation">
                <ul>
                    <li><a href="<?php echo Yii::$app->homeUrl;?>" class="<?php echo Core::getActiveClass('index'); ?>">home</a></li>
                    <li><?php echo Html::a('About Us',['site/about'], ['class' => Core::getActiveClass('about')]);?></li>
                    <li><?php echo Html::a('Services',['site/service'], ['class' => Core::getActiveClass('service')]);?></li>
                    <li><?php echo Html::a('Testiomonials',['site/testimonial'], ['class' => Core::getActiveClass('testimonial')]);?></li>
                    <li><?php echo Html::a('Contact',['site/contact'], ['class' => Core::getActiveClass('contact')]);?></li>
                    <li style="background:none;"><?php echo Html::a('login',['site/login']);?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div> 