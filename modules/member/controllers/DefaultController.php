<?php

namespace app\modules\member\controllers;
use Yii;
use app\modules\member\Controller;
use app\models\UserMaster;
use app\lib\Core;
use app\lib\CustomFunctions;
use app\lib\VEmail;
use yii\web\UploadedFile;
use app\modules\member\models\UserInterest;
use app\modules\member\models\UserShortlist;
/**
 * Default controller for the `member` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = $this->findModel(Core::getLoggedUserID());  
        return $this->render('index',[
            'model'=>$model
        ]);
    }

    public function actionEditprofile()
    {
    	$model = $this->findModel(Core::getLoggedUserID());
        if ($model->load(Yii::$app->request->post())) {
            $model->fileName=UploadedFile::getInstance($model, 'fileName');
            if($model->save())
            {
                return $this->redirect(['index']);
            }
        }
    	return $this->renderAjax('editProfile',[
    		'model'=>$model
    	]);
    }

    public function actionMobilenumber()
    {
        $model = $this->findModel(Core::getLoggedUserID());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->renderAjax('updateMobileNumber',[
            'model'=>$model
        ]);
    }

    public function actionPersonalinfoupdate()
    {
        $model = $this->findModel(Core::getLoggedUserID());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->renderAjax('updatePersonalInfo',[
            'model'=>$model
        ]);
    }
    
    public function actionPartnerpreference()
    {
      $model = $this->findModel(Core::getLoggedUserID());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->renderAjax('updatePartnerPreference',[
            'model'=>$model
        ]);  
    }
    
    public function actionAboutfamily()
    {
      $model = $this->findModel(Core::getLoggedUserID());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->renderAjax('updateAboutFamily',[
            'model'=>$model
        ]);  
    }

    public function actionGroomlocationupdate()
    {
      $model = $this->findModel(Core::getLoggedUserID());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->renderAjax('updateGroomLocation',[
            'model'=>$model
        ]);  
    }

    public function actionBasicinfoupdate(){
        $model = $this->findModel(Core::getLoggedUserID());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->renderAjax('updateBasicInfo',[
            'model'=>$model
        ]); 
    }
	
	public function actionReligioninformationupdate(){
        $model = $this->findModel(Core::getLoggedUserID());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->renderAjax('updateReligionInformation',[
            'model'=>$model
        ]); 
    }

    public function actionMatches()
    {
        $model = new UserMaster;  
        return $this->render('profileMatches',[
            'model'=>$model
        ]);
    }
	
	public function actionStateagainstcountry($countryID)
	{
		$stateData = CustomFunctions::getStateAssoc($countryID);
		return json_encode($stateData);
	}
	
	public function actionGothramagainstreligion($religionID)
	{
		$gothramData = CustomFunctions::getGothramAssoc($religionID);
		return json_encode($gothramData);
	}
	
	public function actionCasteagainstreligion($religionID)
	{
		$casteData = CustomFunctions::getCasteAssoc($religionID);
		return json_encode($casteData);
	}
	
	public function actionSendinterest($sendToUserID)
	{
		$userDetail = Core::getLoggedUser();
		$userInterestModel = new UserInterest();
		$userInterestModel->sendByUserID = $userDetail->id;
		$userInterestModel->sendToUserID = $sendToUserID;
		//$userInterestModel->messageSent = '';
		$userInterestModel->viewStatus = 0;
		$userInterestModel->acceptedRejectedStatus = 0;
		if($userInterestModel->save())
		{
			VEmail::sendInterestMail($userDetail->id, $sendToUserID);
		}
		
		return true;
	}
	
	public function actionShortlist($shortlistedUserID)
	{
		$userDetail = Core::getLoggedUser();
		$shortlistedStatus = UserShortlist::find()->where(['shortlistedByUserID' => $userDetail->id, 'shortlistedUserID' => $shortlistedUserID])->count();
		if($shortlistedStatus == 0)
		{
			$userShortlistModel = new UserShortlist();
			$userShortlistModel->shortlistedByUserID = $userDetail->id;
			$userShortlistModel->shortlistedUserID = $shortlistedUserID;
			$userShortlistModel->status = 0;
			$userShortlistModel->save();
		}
		else
		{
			return false;
		}
		
		return true;
	}
	
	public function actionChangepassword($id)
	{
		$userModel = $this->findModel($id);
		
		if($userModel->load(Yii::$app->request->post()))
        {
			$userModel->scenario = 'reset_password';
			
			if($userModel->newPassword != $userModel->confirmPassword)
			{
				Yii::$app->session->setFlash('error', '<div class="text-red">Confirm Password Mismatch</div>');
			}
			else
			{
				$userModel->userPassword = $userModel->confirmPassword;
				$userModel->isForgotPasswordKeyExpired = 1;
				
				if ($userModel->save()) {
					Yii::$app->session->setFlash('error', '<div class="text-green">Password changed Successfully</div>');
					return $this->redirect(['changepassword', 'id' => $id]);
				}
				else{
					Yii::$app->session->setFlash('error', Core::createErrorlist($userModel->getErrors()));
				}
			}
		}
		
		return $this->render('changepassword', [
			'model' => $model,
		]);
	}

    protected function findModel($id)
    {
        if (($model = UserMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
