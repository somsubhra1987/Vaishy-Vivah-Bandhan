<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\UserUploadedImages;
use app\modules\admin\models\UserUploadedImagesSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UploadedimagesController implements the CRUD actions for UserUploadedImages model.
 */
class UploadedimagesController extends ControllerAdmin
{
    public $enableCsrfValidation = false;
    /**
     * Lists all UserUploadedImages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserUploadedImagesSearch();
        $searchModel->refTable = 'user_master';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserUploadedImages model.
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
     * Creates a new UserUploadedImages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserUploadedImages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserUploadedImages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserUploadedImages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserUploadedImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UserUploadedImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserUploadedImages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionApproved(){
        $response = array();
        $imageID = $_REQUEST['imageID'];
        $checkedStatus = $_REQUEST['checkedStatus'];
        $model = $this->findModel($imageID);
        if(!empty($model)){
            $model->adminVerifiedStatus = $checkedStatus;
            $model->save();
            $response['status']='success';
            $response['message']='Updated successfully';
            exit(json_encode($response));
        }
        $response['status']='error';
        $response['message']='Not updated';
        exit(json_encode($response));
    }
}
