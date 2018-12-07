<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\assets\AppAsset;
use app\lib\core\Cms;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<title>Vivah Bandhan</title>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>    

<?php $this->head() ?>    
<?php echo $this->registerCssFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/css/style.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);?>
<?php echo $this->registerCssFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/css/flexslider.css');?>
<link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<style type="text/css">
 .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index:9999 !important;
    top: 0;
    left: 0;
    background-color: #99491b;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top:60px;
}
.closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px !important;
    margin-left: 50px;
}

@media screen and (max-height: 1050px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
<script type="text/javascript">
function openNav() {
	document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
}
</script>
</head>
<body>
<?php $this->beginBody() ?>

<div id="wraper">
