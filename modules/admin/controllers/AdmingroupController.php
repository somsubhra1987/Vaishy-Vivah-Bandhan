<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\AppAdminGroup;
use app\modules\admin\models\AppAdminGroupSearch;
use app\modules\admin\controllers\ControllerAdmin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdmingroupController implements the CRUD actions for AppAdminGroup model.
 */
class AdmingroupController extends ControllerAdmin
{
   
    /**
     * Lists all AppAdminGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppAdminGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AppAdminGroup model.
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
     * Creates a new AppAdminGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AppAdminGroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        Yii::$app->session->setFlash('flashSuccess', 'Admin group has been successfully created.');
            return $this->redirect(['admingroup/#']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AppAdminGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        Yii::$app->session->setFlash('flashSuccess', 'Admin group has been successfully updated.');
            return $this->redirect(['admingroup/#']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AppAdminGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete())
        {
			Yii::$app->session->setFlash('flashSuccess', 'Admin group has been successfully deleted.');
        	return $this->redirect(['index']);
    	}
    }

    /**
     * Finds the AppAdminGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AppAdminGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AppAdminGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
