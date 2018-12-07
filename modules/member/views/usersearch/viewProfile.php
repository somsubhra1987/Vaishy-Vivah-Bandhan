<?php

use yii\helpers\Html;
use app\models\UserMaster;
use app\lib\Core;
use app\lib\CustomFunctions;
/* @var $this yii\web\View */
/* @var $model app\modules\member\models\AppUser */
/* @var $form yii\widgets\ActiveForm */
$this->title = "View Profile";

$userDetail = UserMaster::findOne(['userID' => $userID]);
$profilePath = Core::getFilePath($userID, 'user_master');
if(!$profilePath){
	$profilePath = Yii::$app->getUrlManager()->getBaseUrl().'/themes/frontend/vivahBandhan/images/user.png';
}
?>
<div class="modal-dialog modal-lg profile-modal" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
      <h4 class="modal-title"><?php echo $userDetail->firstName.' '.$userDetail->lastName; ?> <span>Last Viewed: 02-Sep-2016</span></h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12"><img src="<?php echo $profilePath; ?>" alt=""></div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div align="center" style="margin-top:10px;"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/themes/frontend/vivahBandhan/images/mobile.png" title="View Mobile Number"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/themes/frontend/vivahBandhan/images/horoscope.png" title=" Requaedt horoscope"></div>

            </div>
          </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <p><strong>Age:</strong> <?php echo Core::getAgeByDate($userDetail->dob); ?> Yrs<br>
            <strong>Height:</strong> <?php echo $userDetail->height; ?><br>
            <strong>Religion:</strong> <?php echo CustomFunctions::getReligionAssoc()[$userDetail->religionID]; ?><br>
            <strong>Caste:</strong> <?php echo CustomFunctions::getCasteAssoc($userDetail->religionID)[$userDetail->casteID]; ?><br>
            <strong>Location:</strong> <?php echo $userDetail->address; ?><br>
            <strong>Education:</strong> <?php echo CustomFunctions::getEducationAssoc()[$userDetail->education]; ?><br>
            <strong>Profession:</strong> <?php echo CustomFunctions::getOccupationAssoc()[$userDetail->occupation]; ?><br>
            <strong>Annual Income:</strong> <?php if($userDetail->annualIncome == 0){ echo 'Not Entered'; }else{ echo $userDetail->annualIncome.' lakhs'; } ?></p>
          <div class="totalwidtharea">
            <p><?php echo $userDetail->partnerPreference; ?></p>
          </div>

        </div>
      </div>
    </div>
    <div class="modal-footer"></div>
  </div>
</div>