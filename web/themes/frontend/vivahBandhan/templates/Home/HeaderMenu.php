<?php
use yii\helpers\Html;
?>
<div class="header-outer index-heaight">
    <div class="banner-area">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <?= Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/banner.jpg", ['alt' => ''])?>
                </li>
                <li>
                    <?= Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/slider-2.jpg", ['alt' => ''])?>
                </li>
                <li>
                    <?= Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/banner1.jpg", ['alt' => ''])?>
                </li>
            </ul>
        </div>
    </div>

    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="index.html">
                <?= Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/logo.png", ['alt' => ''])?>                
                </a>
            </div>
            <div class="contact">
                <?= Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/WhatsApp_Icon.png", ['alt' => '', 'align'=>'absmiddle'])?> : 9903809974
                <?= Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/phone.png", ['alt' => '', 'align'=>'absmiddle'])?> : +91 9674535521
            </div>
            <div class="navigation">
                <ul>
                    <li><a href="index.html" class="active">home</a>
                    </li>
                    <li><a href="about-us.html">About Us</a>
                    </li>
                    <li><a href="service.html">Services</a>
                    </li>
                    <li><a href="testiomonials.html">Testiomonials</a>
                    </li>
                    <li><?=Html::a('Contact',['site/contact'])?></li>
                    <li style="background:none;"><?=Html::a('login',['site/login'])?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div> 