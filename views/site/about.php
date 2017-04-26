<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\lib\Cms;
$this->title = 'About Vaishy Vivah';

?>
<!--mid-container-->

<div class="clear"></div>
<div class="mid-container">
  <div class="about-area">
    <div class="container">
      <?=Cms::getBlockContent("about_content")?>
    </div>
  </div>
</div>