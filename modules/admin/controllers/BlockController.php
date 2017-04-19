<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\CmsBlock;
use app\modules\admin\models\CmsBlockSearch;
use app\modules\admin\ControllerAdmin;
use app\lib\Core;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * BlockController implements the CRUD actions for CmsBlock model.
 */
class BlockController extends ControllerAdmin
{
     /**
     * Lists all CmsBlock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CmsBlockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new CmsBlock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsBlock();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {	        
			Yii::$app->session->setFlash('success', 'Block has been successfully created.');
			return $this->redirect(['index']);		
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsBlock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);	
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
			Yii::$app->session->setFlash('success', 'Block has been successfully updated.');
			return $this->redirect(['index']);			
        } 
        else 
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsBlock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
	    $model = $this->findModel($id);
		if($this->findModel($id)->delete())
		{
			Yii::$app->session->setFlash('success', 'Block has been successfully deleted.');
		}	
        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsBlock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CmsBlock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsBlock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
