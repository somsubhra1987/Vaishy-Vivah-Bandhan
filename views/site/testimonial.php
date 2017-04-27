<?php

use yii\helpers\Html;
use app\modules\admin\models\Testimonials;

$this->title = 'Vaishy Vivah Testimonials';

$testimonialsDetail = Testimonials::find()->orderBy(['dateTimeCreated' => SORT_DESC])->all();
?>
<!---------mid-container--------------->

<div class="clear"></div>
<div class="mid-container">
  <div class="testimonial-area">
    <div class="container">
    <?php $i=0; foreach($testimonialsDetail as $testimonials){ ?>
      <!---------testimonial--------------->
      <div class="testimonial"> <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/datafiles/testimonial_image/main/main_".$testimonials->coupleImage, ['alt' => '', 'align' => 'left']);?>
        <h1><?php echo $testimonials->groomName.' &amp; '.$testimonials->brideName; ?></h1>
        <h2><em><?php echo $testimonials->groomName; ?></em></h2>
        <p><?php echo $testimonials->groomShortDescription; ?></p>
        <h2><?php echo $testimonials->brideName; ?></h2>
        <p><?php echo $testimonials->brideShortDescription; ?></p>
        <div class="clear"></div>
      </div>
      <?php if($i > 0 && $i%2 == 0){ ?>
      <div class="line1"></div>
      <?php } ?>
      <!---------testimonial--------------->
  	<?php } ?>
    </div>
    <div class="clear"></div>
  </div>
</div>