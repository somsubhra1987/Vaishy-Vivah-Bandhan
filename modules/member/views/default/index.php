<?php
use app\lib\Core;
use app\lib\CustomFunctions;
?><!-- Start Feature -->
<section id="feature">
    <div class="container">

        <div class="space top-space"></div>

        <div class="row">
            <div class="col-md-12">

                <div class="space"></div>
       
                <div class="col-md-9 no-padding">
       
                    <div class="col-lg-11 white-bg">
                        <div class="col-lg-3 no-padding">
                            <?php
                            $userDetail = Core::getLoggedUser();
                            $profilePath = Core::getProfileImagePath($userDetail->userID, 'user_master');
                            if(!$profilePath){
                                $profilePath = Yii::$app->getUrlManager()->getBaseUrl().'/themes/frontend/vivahBandhan/images/user.png';
                            }
                            ?>

                            <img src="<?=$profilePath?>" width="100%" class="img-thumbnail">
                            <?php
                            $updateUrl = Yii::$app->getUrlManager()->createUrl(['member/default/editprofile']);
                            ?>
                            <a class="edit-profile" href="javascript:void(0);" onclick="getModalData('<?=$updateUrl?>',this);">Edit Profile/Upload Photo</a>                            
                        </div>
                        <div class="col-lg-9">
                            <h2><?=$userDetail->name?></h2>                            
                            <p>
                            <?php
                            if($model->profileCreatedFor != 0){
                            ?>
                            Profile created for <?=CustomFunctions::getProfileCreatedForAssoc()[$model->profileCreatedFor]?> <br>
                            <?php
                            }
                            ?>
                             <?php echo Core::getAgeByDate($model->dob)?> Yrs, <?php echo $model->height?>  ft / <?php echo round($model->height * 30.48, 0); ?> Cms<br>
                            <?php if($model->religionID > 0){ echo CustomFunctions::getReligionAssoc()[$model->religionID]; } if($model->casteID > 0){ echo ', '.CustomFunctions::getCasteAssoc($model->religionID)[$model->casteID]; } ?><br>
                            <?php echo $model->city.', '.CustomFunctions::getStateAssoc($model->country)[$model->state].', '.core::getCountryAssoc()[$model->country];?><br>
                            <?php echo CustomFunctions::getEducationAssoc()[$model->education].', '.CustomFunctions::getOccupationAssoc()[$model->occupation];?>
                            </p>
                            <p>
                            <?php
                            $updateMobileUrl = Yii::$app->getUrlManager()->createUrl(['member/default/mobilenumber']);
                            ?>
                            <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/cell-phone-icon-png.png" width="15"> <?=$model->phoneNo?> (  Verified )  <a class="blue-text"  href="javascript:void(0);" onclick="getModalData('<?=$updateMobileUrl?>',this);">Edit Mobile No</a></p>
                        </div>
                    </div>

                    <?php
                    $updatePersonalinfoUrl = Yii::$app->getUrlManager()->createUrl(['member/default/personalinfoupdate']);
                    ?>

                    <div class="col-lg-11 white-bg">
                        <a href="javascript:void(0);" onclick="getModalData('<?=$updatePersonalinfoUrl?>',this);" class="edit-area"> <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/edit.png"> Edit</a>  
                        <h2>Personal Information</h2>
                        <p>
                            <?=$model->personalInfo?>
                         </p>
                    </div>
                    <?php
                    $updateBasicinfoUrl = Yii::$app->getUrlManager()->createUrl(['member/default/basicinfoupdate']);
                    ?>
                    <div class="col-lg-11 white-bg">
                        <a href="javascript:void(0);" onclick="getModalData('<?=$updateBasicinfoUrl?>',this);" class="edit-area"> <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/edit.png"> Edit</a>  
                        <h2>Basic Details</h2>
                        <p>
            
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td >Name : </td>
                                <td class="name-table"><?=$userDetail->name?></td>
                                <td>Age :</td>
                                <td  class="name-table"><?php echo Core::getAgeByDate($model->dob)?> Years</td>
                            </tr>


                            <tr>
                                <td>Profile created for : </td>
                                <td  class="name-table">
                                <?php
                                if($model->profileCreatedFor !== null){
                                ?>
                                <?=CustomFunctions::getProfileCreatedForAssoc()[$model->profileCreatedFor]?>
                                <?php
                                }
                                ?> 
                                </td>
                                <td>Body Type / Complexion :</td>
                                <td  class="name-table">
                                <?php
                                if($model->bodyType !== null){
                                echo CustomFunctions::getBodyTypeAssoc()[$model->bodyType];
                                }
                                ?>                                    
                                </td>
                            </tr>

                            <tr>
                                <td>Physical Status : </td>
                                <td  class="name-table"><?php echo $model->physicalStatus?></td>
                                <td>Height :</td>
                                <td  class="name-table"><?php echo $model->height?>ft.</td>
                            </tr>
                            
                            <tr>
                                <td>Annual Income : </td>
                                <td class="name-table"><?php if($model->annualIncome ==0 ){ echo 'Not Entered'; }else{ echo $model->annualIncome.' lakhs'; }?></td>
                                <td>Gender : </td>
                                <td class="name-table"><?php echo $model->gender?></td>
                            </tr>
                        </table>

                        </p>
                    </div>
              
              		<?php
                    $updateReligionInformationUrl = Yii::$app->getUrlManager()->createUrl(['member/default/religioninformationupdate']);
                    ?>
                    <div class="col-lg-11 white-bg">
                        <a href="javascript:void(0);" onclick="getModalData('<?=$updateReligionInformationUrl?>',this);" class="edit-area"> <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/edit.png"> Edit</a>  
                        <h2>Religion Information</h2>

                        <p>
            
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td >Religion : </td>
                                <td class="name-table"><?php if($model->religionID > 0){ echo CustomFunctions::getReligionAssoc()[$model->religionID]; }?></td>
                            </tr>
                            <tr>
                                <td>Gothram : </td>
                                <td  class="name-table"><?php if($model->gothramID > 0){ echo CustomFunctions::getGothramAssoc($model->religionID)[$model->gothramID]; }?></td>
                            </tr>
                            <tr>
                                <td>Caste : </td>
                                <td  class="name-table"><?php if($model->casteID > 0){ echo CustomFunctions::getCasteAssoc($model->religionID)[$model->casteID]; }?></td>
                            </tr>
                        </table>
                        </p>
                    </div>
                    <?php
                    $updateGroomlocationUrl = Yii::$app->getUrlManager()->createUrl(['member/default/groomlocationupdate']);
                    ?>

                    <div class="col-lg-11 white-bg">
                        <a href="javascript:void(0);" onclick="getModalData('<?=$updateGroomlocationUrl?>',this);" class="edit-area"> <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/edit.png"> Edit</a>  
                        <h2>Groom's Location</h2>
                        <p>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td >Country : </td>
                                <td class="name-table"><?=Core::getCountryAssoc()[$model->country]?></td>
                            </tr>
                            <tr>
                                <td>State : </td>
                                <td  class="name-table"><?=CustomFunctions::getStateAssoc($model->country)[$model->state]?></td>
                            </tr>
                            <tr>
                                <td> City                 : </td>
                                <td  class="name-table"><?=$model->city?></td>
                            </tr>
                        </table>
                        </p>
                    </div>
              
                    <?php
                    $updateAboutFamilyUrl = Yii::$app->getUrlManager()->createUrl(['member/default/aboutfamily']);
                    ?>
                    <div class="col-lg-11 white-bg">
                        <a href="javascript:void(0);" onclick="getModalData('<?=$updateAboutFamilyUrl?>',this);" class="edit-area"> <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/edit.png"> Edit</a>  
                        <h2>About My Family </h2>
                        <p><?=$model->aboutFamily?></p>
                    </div>
                    <?php
                    $updatePartnerpreferenceUrl = Yii::$app->getUrlManager()->createUrl(['member/default/partnerpreference']);
                    ?>              
                    <div class="col-lg-11 white-bg">
                        <a href="javascript:void(0);" onclick=getModalData("<?=$updatePartnerpreferenceUrl?>",this) class="edit-area"> <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images/edit.png"> Edit</a>  
                        <h2>Partner Preference</h2>
                        <p><?=$model->partnerPreference?></p>
                    </div>
                </div>
           
                <div class="col-md-3 white-bg">
                    <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images//300x600.jpg" class="img-thumbnail" width="100%">
                    <div class="space"></div>
                    <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images//300x600-1.jpg" class="img-thumbnail" width="100%"> 
                    <div class="space"></div>
                    <img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/themes/frontend/vivahBandhan/images//300x600-2.png" class="img-thumbnail" width="100%">
                </div>      
       
            </div>
        </div><!-- Row-->        
    </div><!--container-->
</section><!--section-->
<!-- End Feature -->