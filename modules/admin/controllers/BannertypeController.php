<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\CmsBannerType;
use app\modules\admin\models\CmsBannerTypeSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * BannertypeController implements the CRUD actions for CmsBannerType model.
 */
class BannertypeController extends ControllerAdmin
{
    /**
     * Lists all CmsBannerType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CmsBannerTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsBannerType model.
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
     * Creates a new CmsBannerType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsBannerType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        Yii::$app->session->setFlash('success', 'Banner type successfully added.');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsBannerType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	         Yii::$app->session->setFlash('success', 'Banner type ' . $model->title. ' updated successfully.');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsBannerType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete())
        {
	       Yii::$app->session->setFlash('success', 'Banner type deleted successfully.');       
	    }
	    else
	    {
		    Yii::$app->session->setFlash('error', 'Refference has been save in other table. You can not delete it.');
		}
		
        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsBannerType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CmsBannerType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsBannerType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
