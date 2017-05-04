<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Settings;
use app\modules\admin\models\SettingsSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class SettingsController extends ControllerAdmin
{

    /**
     * Lists all Settings models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = new Settings();
		$settingDetailArr = Settings::find()->all();//print_r($settingDetailArr);
		foreach($settingDetailArr as $settingDetail)
		{
			if($settingDetail->type == 'contact_person')
			{
				$model->contactPerson = $settingDetail->value;
			}
			if($settingDetail->type == 'contact_no')
			{
				$model->contactNo = $settingDetail->value;
			}
			if($settingDetail->type == 'whatsapp_no')
			{
				$model->whatsappNo = $settingDetail->value;
			}
			if($settingDetail->type == 'email_id')
			{
				$model->emailID = $settingDetail->value;
			}
			if($settingDetail->type == 'facebook_link')
			{
				$model->facebookLink = $settingDetail->value;
			}
			if($settingDetail->type == 'twitter_link')
			{
				$model->twitterLink = $settingDetail->value;
			}
			if($settingDetail->type == 'gplus_link')
			{
				$model->gplusLink = $settingDetail->value;
			}
			if($settingDetail->type == 'youtube_link')
			{
				$model->youtubeLink = $settingDetail->value;
			}
			if($settingDetail->type == 'rss_link')
			{
				$model->rssLink = $settingDetail->value;
			}
			if($settingDetail->type == 'map_link')
			{
				$model->mapLink = $settingDetail->value;
			}
		}
	
		return $this->render('view', [
            'model' => $model,
        ]);
	
        /*$searchModel = new SettingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
    }

    /**
     * Displays a single Settings model.
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
     * Creates a new Settings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Settings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->settingsID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->settingsID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Settings model.
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
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Settings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
