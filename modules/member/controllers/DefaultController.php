<?php

namespace app\modules\member\controllers;
use Yii;
use app\modules\member\Controller;
use app\models\UserMaster;
use app\lib\Core;
use app\lib\CustomFunctions;
use yii\web\UploadedFile;
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

    protected function findModel($id)
    {
        if (($model = UserMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
