<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\lib\Core;

NavBar::begin([
'brandLabel' => Html::img('@web/themes/backend/default/images/logo.png', ['alt'=>Yii::$app->name]),
'brandOptions' => ['class' => 'brand-logo'],
'brandUrl' => Yii::$app->urlManager->createUrl(['/admin/dashboard']),
'options' => [
    'class' => 'navbar-inverse navbar-fixed-top',
],
]);


echo Nav::widget([
'options' => ['class' => 'navbar-nav navbar-right'],
'items' => [
    ['label' => 'My Account', 'url' => ['/admin/profile/profileedit']],
    [
    'label' => 'Logout ('. Core::getLoggedAdmin()->username .')',
    'url' => ['/admin/logout'],
    'linkOptions' => ['data-method' => 'post']
    ],
],
]);
NavBar::end();
?>