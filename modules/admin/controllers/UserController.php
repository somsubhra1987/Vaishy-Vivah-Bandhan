<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\UserMaster;
use app\modules\admin\models\UserMasterSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\lib\CustomFunctions;

/**
 * UserController implements the CRUD actions for UserMaster model.
 */
class UserController extends ControllerAdmin
{
    /**
     * Lists all UserMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserMaster model.
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
     * Creates a new UserMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserMaster();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->userID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->userID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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

    /**
     * Deletes an existing UserMaster model.
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
     * Finds the UserMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UserMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
