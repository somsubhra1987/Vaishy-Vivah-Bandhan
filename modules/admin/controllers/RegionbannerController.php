<?php

namespace app\modules\admin\controllers;

use Yii;
use app\lib\Core;
use app\modules\admin\models\CmsRegionBanner;
use app\modules\admin\models\CmsRegionBannerSearch;
use app\modules\admin\models\CmsRegionObject;
use app\modules\admin\ControllerAdmin;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegionbannerController implements the CRUD actions for CmsRegionBanner model.
 */
class RegionbannerController extends ControllerAdmin
{
    /**
     * Lists all CmsRegionBanner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CmsRegionBannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsRegionBanner model.
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
     * Creates a new CmsRegionBanner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsRegionBanner();	
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {      
	        Yii::$app->session->setFlash('success', 'Banner region successfully added.');           
            return $this->redirect(['banner/#'.$model->regionBannerID]); 
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsRegionBanner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->regionID = Core::getSelectedThemeRegionID($id, 'cms_region_banner');
		
		$modelRegionObject = new CmsRegionObject();
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {	            
	        Yii::$app->session->setFlash('success', $model->title. ' successfully updated.');
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
     * Deletes an existing CmsRegionBanner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete())
        {
			Yii::$app->session->setFlash('success', 'Region successfully deleted.');
		}
        return $this->redirect(['banner/#']);
        
    }

    /**
     * Finds the CmsRegionBanner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CmsRegionBanner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsRegionBanner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
