<?php
use yii\helpers\Html;
use app\lib\Cms;
$this->title = 'Vaishy Vivah Services';
?>
<!--mid-container-->

<div class="clear"></div>
<div class="mid-container">
  <div class="gallery-area">
    <div class="container">
      <?=Cms::getBlockContent("service_content")?>      
    </div>
  </div>
</div>