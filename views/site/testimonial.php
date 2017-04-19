<?php
use yii\helpers\Html;

$this->title = 'Vaishy Vivah Testimonials';
?>
<!---------mid-container--------------->

<div class="clear"></div>
<div class="mid-container">
  <div class="testimonial-area">
    <div class="container">
    <?php for($i = 0; $i <=2; $i++){ ?>
      <!---------testimonial--------------->
      <div class="testimonial"> <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/saket-mahendra.jpg", ['alt' => '', 'align' => 'left']);?>
        <h1>Saket Mahendra &amp; Divya puri</h1>
        <h2><em>Saket Mahendra</em></h2>
        <p><strong>S/o:</strong> Mr.Deepak Kumar Mahendra <br />
          Mumbai</p>
        <h2>Divya Puri</h2>
        <p><strong>D/o:</strong>Mr.Surinder Kumar Puri <br />
          Business:Puri construction. Two stone Crushing Compani in Jammu &amp; Kashmir</p>
        <div class="clear"></div>
      </div>
      <!---------testimonial--------------->
      <div class="testimonial m-r"> <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/saket-mahendra.jpg", ['alt' => '', 'align' => 'left']);?>
        <h1>Saket Mahendra &amp; Divya puri</h1>
        <h2><em>Saket Mahendra</em></h2>
        <p><strong>S/o:</strong> Mr.Deepak Kumar Mahendra <br />
          Mumbai</p>
        <h2>Divya Puri</h2>
        <p><strong>D/o:</strong>Mr.Surinder Kumar Puri <br />
          Business:Puri construction. Two stone Crushing Compani in Jammu &amp; Kashmir</p>
        <div class="clear"></div>
      </div>
      <?php if($i < 2){ ?>
      <div class="line1"></div>
      <?php } ?>
      <!---------testimonial--------------->
  	<?php } ?>
    </div>
    <div class="clear"></div>
  </div>
</div>