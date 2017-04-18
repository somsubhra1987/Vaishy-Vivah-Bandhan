<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\CmsPage;
use app\modules\admin\models\CmsPageSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for CmsPage model.
 */
class PageController extends ControllerAdmin
{
    /**
     * Lists all CmsPage models.
     * @return mixed
     */
    public function actionIndex()
    {
	    $model = new CmsPage();
		$pageTypeArr = $model->getListPageTypeArray();      
		$searchModel = new CmsPageSearch();
        return $this->render('index', [
            'model'=>$model,
			'pageTypeArr'=>$pageTypeArr,
			'searchModel' => $searchModel, 
        ]);
    }

    /**
     * Displays a single CmsPage model.
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
     * Creates a new CmsPage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new CmsPage();
		$model->pageTypeID = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        Yii::$app->session['pageID'] = $model->pageID;
	        Yii::$app->session->setFlash('pageTypeID',$model->pageTypeID);
	        Yii::$app->session->setFlash('success', 'Page has been successfully created.');
            return $this->redirect(['page/#'.$model->pageTypeID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsPage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        Yii::$app->session->setFlash('pageTypeID',$model->pageTypeID);
	        Yii::$app->session['pageID'] = $model->pageID;
	        Yii::$app->session->setFlash('success', 'Page has been successfully updated.');
            return $this->redirect(['page/#'. $model->pageTypeID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsPage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
	    $model = $this->findModel($id);
        if($this->findModel($id)->delete())
        {
	        Yii::$app->session->setFlash('pageTypeID',$model->pageTypeID);
			Yii::$app->session->setFlash('success', 'Page has been successfully deleted.');
        	return $this->redirect(['page/#'.$model->pageTypeID]);
   	 	}
    }

    /**
     * Finds the CmsPage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CmsPage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsPage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDeletepagetype()
    {
		$pageTypeID = $_REQUEST['pageTypeID'];
		if($pageTypeID)
		{
			$model=new CmsPage();
			if($model->deletePageTypeByID($pageTypeID))
			{
				Yii::$app->session->setFlash('success', 'Pagetype has been successfully deleted.');
				$response =1;
				$message = "Successfully Deleted";
			}
			else
			{
				$response = 0;
				$message = "Not deleted, Please delete page list before deleting Pagetype.";
				Yii::$app->session->setFlash('error', 'Not deleted, Please delete page list before deleting Pagetype.');	
			}
			$success =['success'=>$response, 'message'=>$message];
			echo json_encode($success);
		}	    
	}	
	
	public function actionContent($id)
	{
		$model = CmsPage::findOne($id);

		return $this->render('content', [
			'model'=>$model
		]);	
	}
}
