<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\CmsBanner;
use app\modules\admin\models\CmsBannerSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BannerController implements the CRUD actions for CmsBanner model.
 */
class BannerController extends ControllerAdmin
{
    /**
     * Lists all CmsBanner models.
     * @return mixed
     */
    public function actionIndex()
    {
	   $bannerModel = new CmsBanner();
	   $bannerRegionArr = $bannerModel->getListBannerRegionArray();

	  
        $searchModel = new CmsBannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'bannerRegionArr' => $bannerRegionArr,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsBanner model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CmsBanner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsBanner();
        $model->regionBannerID = $_GET['regionId'];
        
		if($model->load(Yii::$app->request->post()) && $model->save())
		{		   
			Yii::$app->session->setFlash('success', 'Banner has been successfully created');
			return $this->redirect(['banner/#'.$model->regionBannerID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsBanner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       	$model->prevImageName = $model->image;
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
	        Yii::$app->session->setFlash('success', 'Banner has been successfully updated');			
			return $this->redirect(['banner/#'.$model->regionBannerID]);				
        } 
        else 
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsBanner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
	    $model = $this->findModel($id);	    
        if($this->findModel($id)->delete())
        {
	    	Yii::$app->session->setFlash('success', 'Banner has been successfully deleted.');    
	    }    
        return $this->redirect(['banner/#'.$model->regionBannerID]);
    }

    /**
     * Finds the CmsBanner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CmsBanner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsBanner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDeleteregionbanner()
    {
	    $regionBannerID = $_REQUEST['regionBannerID'];
		if($regionBannerID)
		{
			$model=new CmsBanner();
			if($model->deleteRegionbannerByID($regionBannerID))
			{
				Yii::$app->session->setFlash('success', 'Region Banner has been successfully deleted.');
				$response =1;
				$message = "Successfully Deleted";
			}
			else
			{
				Yii::$app->session->setFlash('error', 'Not deleted, Please delete Banner list before deleting Region Banner.');
				$response = 0;
				$message = "Not deleted, Please delete Banner list before deleting Region Banner.";	
			}
			$success =['success'=>$response, 'message'=>$message];
			echo json_encode($success);
		}	
	}
}
