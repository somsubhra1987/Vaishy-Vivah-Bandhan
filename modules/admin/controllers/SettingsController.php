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
		if ($model->load(Yii::$app->request->post())) {
		
			$model->truncateTable();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'contact_person';
			$settingsModel->value = $model->contactPerson;
			$settingsModel->save();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'designation';
			$settingsModel->value = $model->designation;
			$settingsModel->save();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'address';
			$settingsModel->value = $model->address;
			$settingsModel->save();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'contact_no';
			$settingsModel->value = $model->contactNo;
			$settingsModel->save();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'whatsapp_no';
			$settingsModel->value = $model->whatsappNo;
			$settingsModel->save();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'email_id';
			$settingsModel->value = $model->emailID;
			$settingsModel->save();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'facebook_link';
			$settingsModel->value = $model->facebookLink;
			$settingsModel->save();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'twitter_link';
			$settingsModel->value = $model->twitterLink;
			$settingsModel->save();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'gplus_link';
			$settingsModel->value = $model->gplusLink;
			$settingsModel->save();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'youtube_link';
			$settingsModel->value = $model->youtubeLink;
			$settingsModel->save();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'rss_link';
			$settingsModel->value = $model->rssLink;
			$settingsModel->save();
			
			$settingsModel = new Settings();
			$settingsModel->type = 'map_link';
			$settingsModel->value = $model->mapLink;
			$settingsModel->save();
			
			return $this->redirect(['index']);
			
        } else {
            $settingDetailArr = Settings::find()->all();
			foreach($settingDetailArr as $settingDetail)
			{
				if($settingDetail->type == 'designation')
				{
					$model->designation = $settingDetail->value;
				}
				if($settingDetail->type == 'address')
				{
					$model->address = $settingDetail->value;
				}
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
		
			return $this->render('create', [
				'model' => $model,
			]);
        }
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

        if ($model->load(Yii::$app->request->post())) {
		
			$model->truncateTable();
		
			$model = new Settings();
			$model->type = 'contact_person';
			$model->value = $model->contactPerson;
			$model->save();
			
			$model = new Settings();
			$model->type = 'contact_no';
			$model->value = $model->contactNo;
			$model->save();
			
			$model = new Settings();
			$model->type = 'whatsapp_no';
			$model->value = $model->whatsappNo;
			$model->save();
			
			$model = new Settings();
			$model->type = 'email_id';
			$model->value = $model->emailID;
			$model->save();
			
			$model = new Settings();
			$model->type = 'facebook_link';
			$model->value = $model->facebookLink;
			$model->save();
			
			$model = new Settings();
			$model->type = 'twitter_link';
			$model->value = $model->twitterLink;
			$model->save();
			
			$model = new Settings();
			$model->type = 'gplus_link';
			$model->value = $model->gplusLink;
			$model->save();
			
			$model = new Settings();
			$model->type = 'youtube_link';
			$model->value = $model->youtubeLink;
			$model->save();
			
			$model = new Settings();
			$model->type = 'rss_link';
			$model->value = $model->rssLink;
			$model->save();
			
			$model = new Settings();
			$model->type = 'map_link';
			$model->value = $model->mapLink;
			$model->save();
			
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
