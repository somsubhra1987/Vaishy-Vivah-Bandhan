<?php
use yii\helpers\Html;
use app\lib\Core;
use app\lib\CustomFunctions;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use app\modules\member\models\UserInterest;
use app\modules\member\models\UserShortlist;

$stateUrl = Yii::$app->getUrlManager()->createUrl(['member/default/stateagainstcountry']);
$sendInterestUrl = Yii::$app->getUrlManager()->createUrl(['member/default/sendinterest']);
$shortlistUrl = Yii::$app->getUrlManager()->createUrl(['member/default/shortlist']);
?>
<!-- Start Feature -->
<section id="feature">
  <div class="container ">

    <div class="space top-space"></div>

    <div class="row">
        <div class="col-md-12">
          <div class="space"></div>
          <!--left-->
            <div class="col-md-3 no-padding">
            <?php $form = ActiveForm::begin(['method'=>'get']);?>
              <div class="col-lg-11 white-bg">
                <h3>Filter  Results  </h3>
                <div class="line"></div>
                <p> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="3"> <h5>Age</h5></td>
                    </tr>
                    <tr>
                      <td> 
                        <select class="form-control" name="userMasterSearch[age]" id="userMasterSearch[age]">
                        <option value="">---</option>
                        <?php 
                        $ageList = Core::getAgeList();
                        foreach ($ageList as $value) {
                            # code...
                            ?>
                            <option <?php if($searchModel->age == $value){?> selected = "selected" <?php }?> > 
                            <?php echo $value?>
                                
                            </option>
                            <?php
                        }
                        ?>                          
                        </select>
                      </td>
                      <td>to</td>
                      <td> 
                        <select class="form-control"  name="userMasterSearch[age2]" id="userMasterSearch[age2]">
                        <option value="">---</option>
                          <?php 
                        $ageList = Core::getAgeList();
                        foreach ($ageList as $value) {
                            # code...
                            ?>
                            <option <?php if($searchModel->age2 == $value){?> selected = "selected" <?php }?> ><?php echo $value?></option>
                            <?php
                        }
                        ?>  
                        </select>
                      </td>
                    </tr> 

                    <tr>
                      <td colspan="3"> <h5>Height</h5></td>
                    </tr>

                    <tr>
                      <td> 
                        <select class="form-control" name="userMasterSearch[height]" id="userMasterSearch[height]">
                        <option value="">---</option>
                          <?php 
                        $heightList = Core::getHeightList();
                        foreach ($heightList as $value) {
                            # code...
                            ?>
                            <option value="<?php echo $value?>"  <?php if($searchModel->height == $value){?> selected = "selected" <?php }?> ><?php echo $value?> ft</option>
                            <?php
                        }
                        ?> 
                        </select>
                      </td>
                      <td>to</td>
                      <td>
                        <select class="form-control" name="userMasterSearch[height2]" id="userMasterSearch[height2]">
                        <option value="">---</option>
                          <?php                         
                        foreach ($heightList as $value) {
                            # code...
                            ?>
                            <option value="<?php echo $value?>"  <?php if($searchModel->height2 == $value){?> selected = "selected" <?php }?> ><?php echo $value?> ft</option>
                            <?php
                        }
                        ?> 
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3"> Education</td>
                    </tr>

                    <tr>
                    <td colspan="3">
                      <select class="form-control" name="userMasterSearch[education]" id="userMasterSearch[education]">
                        <option value="">---</option>
                        <?php foreach(CustomFunctions::getEducationAssoc() as $key => $value){ ?>
                        <option value="<?php echo $key; ?>" <?php if($searchModel->education == $key){ ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    </tr>

                    <tr>
                      <td colspan="3"> Employed in</td>
                    </tr>

                    <tr>
                      <td colspan="3">
                        <select class="form-control" name="userMasterSearch[employmentSector]" id="userMasterSearch[employmentsector]">
                          <option value="">---</option>
                          <?php foreach(CustomFunctions::getEmploymentSectorAssoc() as $key => $value){ ?>
                          <option value="<?php echo $key; ?>" <?php if($searchModel->employmentSector == $key){ ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="3"> Occupation</td>
                    </tr>

                    <tr>
                      <td colspan="3">
                        <select class="form-control" name="userMasterSearch[occupation]" id="usermastersearch-occupation">
                          <option value="">---</option>
                          <?php foreach(CustomFunctions::getOccupationAssoc() as $key => $value){ ?>
                          <option value="<?php echo $key; ?>" <?php if($searchModel->occupation == $key){ ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="3"> Country living in </td>
                    </tr>
                    <tr>
                      <td colspan="3">
                        <select class="form-control" name="userMasterSearch[country]" id="usermastersearch-country" onchange="getState(this.value);">
                          <option value="">---</option>
                          <?php foreach(Core::getCountryAssoc() as $key => $value){ ?>
                          <option value="<?php echo $key; ?>" <?php if($searchModel->country == $key){ ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="3"> State </td>
                    </tr>
                    <tr>
                      <td colspan="3">
                        <select class="form-control" name="userMasterSearch[state]" id="usermastersearch-state">
                          <option value="">---</option>
                          <?php if($searchModel->state){ foreach(Core::getStateAssoc($searchModel->country) as $key => $value){ ?>
                          <option value="<?php echo $key; ?>" <?php if($searchModel->state == $key){ ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
                          <?php } } ?>
                        </select>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="3"> Body type</td>
                    </tr>

                    <tr>
                      <td colspan="3">
                        <select class="form-control" name="userMasterSearch[bodyType]" id="usermastersearch-bodytype">
                          <option value="">---</option>
                          <?php foreach(CustomFunctions::getBodyTypeAssoc() as $key => $value){ ?>
                          <option value="<?php echo $key; ?>" <?php if($searchModel->bodyType == $key){ ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                    </tr>


                    <tr>
                      <td colspan="3">
                        <?= Html::submitButton('Submit', ['class' =>'btn btn-primary']) ?>           
                      </td>
                    </tr>
                  </table>
                </div>
                <?php ActiveForm::end(); ?>


                <div class="col-lg-11">
                  <div class="line"></div>
                  <p>
                    <span class="blue-text"> Call 1800 3000 6622 </span>
                    to know more about paid services
                  </p>
                  <div class="line"></div>
                </div>

                <div class="col-lg-11 white-bg">
                  <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/ads-300x250.gif" width="100%" class="">
                </div>
              </div>


        <!--Middle-->

              <div class="col-md-6 white-bg">
                <h3> Users shortlist me </h3>
                <div class="line"></div>

                <div class="col-lg-12 no-padding">
                <?php
                foreach ($dataProvider as $searchList) {
				      $interestCount = UserInterest::find()->where(['sendByUserID' => Core::getLoggedUser()->id, 'sendToUserID' => $searchList->userID])->orWhere(['sendToUserID' => Core::getLoggedUser()->id, 'sendByUserID' => $searchList->userID])->count();
					  
					  $shortlistedStatus = UserShortlist::find()->where(['shortlistedByUserID' => Core::getLoggedUser()->id, 'shortlistedUserID' => $searchList->userID])->count();
                ?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="match">
                    <tr>
                      <td  align="left" valign="top"> <h2><?=$searchList->firstName?></h2>
                        <p class="gray-text">
                            <?=$searchList->profileID?>
                            <?php 
                            if($searchList->profileCreatedFor){
                                ?>
                             | Profile Created by <?=CustomFunctions::getProfileCreatedForAssoc()[$searchList->profileCreatedFor]?>
                             <?php
                            }
                            ?>
                        </p>                      </td>
                      <td  align="left" valign="top"  class="gray-text">
                        <p>
                        <a href="#" title="View Mobile  Number"> <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/mobile.png" title="View Mobile  Number"></a>
                        <a href="#" title="Requaedt horoscope "> <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/horoscope.png" title=" Requaedt horoscope "></a>                        </p>
                        Last Viewed : 02-Sep-2016                      </td>                  
                    </tr>
                    <?php                    
                    $profilePath = Core::getFilePath($searchList->userID, 'user_master');
                    if(!$profilePath){
                        $profilePath = Yii::$app->getUrlManager()->getBaseUrl().'/themes/frontend/vivahBandhan/images/user.png';
                    }
                    ?>
                    <tr>
                      <td  align="left" valign="top"> <a href="#"><img src="<?=$profilePath?>" width="100%"></a>                      </td>
                      <td  align="left" valign="top"  class="gray-text">
                        <p> <strong> Age:</strong><?php echo Core::getAgeByDate($searchList->dob)?>  Yrs </p>
                        <p> <strong> Height:</strong> <?php echo $searchList->height?> ft.</p>
                        <p> <strong>  Religion:</strong> <?= CustomFunctions::getReligionAssoc()[$searchList->religionID]; ?></p>
                        <p> <strong> Caste:</strong> <?= CustomFunctions::getCasteAssoc($searchList->religionID)[$searchList->casteID]; ?></p>
                        <p> <strong>  Location:</strong> <?=$searchList->address?></p>
                        <p> <strong> Education :</strong> <?= CustomFunctions::getEducationAssoc()[$searchList->education]; ?></p>
                        <p> <strong> Profession:</strong> <?= CustomFunctions::getOccupationAssoc()[$searchList->occupation]; ?></p>
                        <p>  <strong>Annual Income:</strong> <?php if($searchList->annualIncome == 0){ echo 'Not Entered'; }else{ echo $searchList->annualIncome.' lakhs'; } ?></p>
                        <a href="#" class="blue-text"> View Full Profile</a>                      </td>                  
                    </tr>
                    <tr>
                      <td colspan="3" align="right">
                        <button type="button" class="btn btn-primary">Send Mail</button>
                        <button type="button" class="btn btn-warning" <?php if($shortlistedStatus > 0){ ?> disabled="disabled" <?php }else{ ?> onclick="shortlistUser(this, <?php echo $searchList->userID; ?>);" <?php } ?>><?php if($shortlistedStatus > 0){ echo 'Shortlisted'; }else{ echo 'Shortlist'; } ?></button>
                        <button type="button" class="btn btn-success" <?php if($interestCount > 0){ ?> disabled="disabled" <?php }else{ ?> onclick="sendInterest(this, <?php echo $searchList->userID; ?>);" <?php } ?>> <span class="glyphicon glyphicon-heart" aria-hidden="true"></span><?php if($interestCount > 0){ echo ' Interest Sent'; }else{ echo ' Send Interest'; } ?></button>                      </td>                  
                    </tr>
                  </table>
                  <?php
                  }
                ?> 
                  <div class="row">
                      <div class="col-sm-12 col-md-12">
                      <?=LinkPager::widget([
                      'pagination' => $pagination,
                      'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span> Prev',
                      'nextPageLabel' => 'Next <span class="glyphicon glyphicon-chevron-right"></span>',
                      'firstPageLabel' => '<span class="glyphicon glyphicon-fast-backward"></span> First',
                      'lastPageLabel' => 'Last <span class="glyphicon glyphicon-fast-forward"></span>',               
                      'maxButtonCount' => 5,
                      ]) ?>
                      </div>
                  </div>                
                </div>
              </div>
        <!--right-->

        <div class="col-md-3 f-r">
          <div class="col-lg-11 white-bg">
            <h4>Discover Matches </h4>
            <div class="line"></div>
            <div>
              <div class="col-lg-4 no-padding">
                <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/user.png" width="100%" class="img-circle">
              </div>
              <div class="col-lg-8">
                <p class="gray-text"> H6427091 | Profile Created by Self </p>
                <p><a href="#"  class="gray-text" > Send email</a></p>
              </div>
            </div>
            <div class="line"></div>
            <div>
              <div class="col-lg-4 no-padding">
                <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/user.png" width="100%" class="img-circle">
              </div>
              <div class="col-lg-8">
                <p class="gray-text"> H6427091 | Profile Created by Self </p>
                <p><a href="#"  class="gray-text" > Send email</a></p>
              </div>
            </div>

            <div class="line"></div>


            <div>
              <div class="col-lg-4 no-padding">
                <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/user.png" width="100%" class="img-circle">
              </div>
              <div class="col-lg-8">
                <p class="gray-text"> H6427091 | Profile Created by Self </p>
                <p><a href="#"  class="gray-text" > Send email</a></p>
              </div>
            </div>

            <div class="line"></div>
            <p align="center"><a href="#"  class="gray-text" ><strong>View All Matches</strong></a></p>
            <div class="line"></div>
            <p><img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/300x600-2.png" width="100%" class=""></p>
          </div>
        </div> 
      </div>
    </div>
  </div> 
</section>
<!-- End Feature -->
<script type="text/javascript">
	function getState(countryID)
	{
		$.ajax({
			method:'GET',
			dataType: 'json',
			url:'<?php echo $stateUrl; ?>',
			data:{countryID:countryID},
			beforeSend:function(){
				$("#usermastersearch-state").html('<option value="">---</options>');
			},
			success:function(response) {
				$.each(response, function(i, value) {
					$('#usermastersearch-state').append($('<option>').text(value).attr('value', i));
				});
			}
		});
	}
	
	function sendInterest(obj, sendToUserID)
	{
		$.ajax({
			method:'GET',
			url:'<?php echo $sendInterestUrl; ?>',
			data:{sendToUserID:sendToUserID},
			beforeSend:function(){
				$(obj).append('<div class="fa fa-spinner fa-spin modal_loader" style="margin-left:4px;"></div>');
			},
			success:function(response) {
				$(".modal_loader").remove();
				$(obj).attr('disabled', 'disabled');
				$(obj).html('<span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Interest Sent');
			}
		});
	}
	
	function shortlistUser(obj, shortlistedUserID)
	{
		$.ajax({
			method:'GET',
			url:'<?php echo $shortlistUrl; ?>',
			data:{shortlistedUserID:shortlistedUserID},
			beforeSend:function(){
				$(obj).append('<div class="fa fa-spinner fa-spin shortlist_modal_loader" style="margin-left:4px;"></div>');
			},
			success:function(response) {
				$(".shortlist_modal_loader").remove();
				if(response)
				{
					$(obj).attr('disabled', 'disabled');
					$(obj).html('Shortlisted');
				}
				else
				{
					alert("You have already shortlisted this user");
				}
			}
		});
	}
</script>