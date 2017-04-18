<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\CmsPageType;
use app\modules\admin\models\CmsPageTypeSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagetypeController implements the CRUD actions for CmsPageType model.
 */
class PagetypeController extends ControllerAdmin
{
 
    /**
     * Lists all CmsPageType models.
     * @return mixed
     */
    public function actionIndex()
    {
	    return $this->redirect(['page/#']);
	     /*
        $searchModel = new CmsPageTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        */
    }

    /**
     * Displays a single CmsPageType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CmsPageType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsPageType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        Yii::$app->session->setFlash('success', 'PageType has been successfully created.');
            return $this->redirect(['page/#']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsPageType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        Yii::$app->session->setFlash('success', 'PageType has been successfully updated.');
            return $this->redirect(['page/#'.$model->pageTypeID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsPageType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsPageType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsPageType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsPageType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
