<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\AppAdmin;
use app\modules\admin\models\AppAdminSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\lib\core\App;

/**
 * AdminController implements the CRUD actions for AppAdmin model.
 */
class AdminuserController extends ControllerAdmin
{
   

    /**
     * Lists all AppAdmin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AppAdmin model.
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
     * Creates a new AppAdmin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AppAdmin();
		$model->scenario ='insert';
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        Yii::$app->session->setFlash('flashSuccess', 'Admin User has been successfully created.');
            return $this->redirect(['adminuser/#']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AppAdmin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $prevPassword = $model->password;
        
		$model->scenario ='update';
        if ($model->load(Yii::$app->request->post())) {
	       $model->confirmpassword = ($model->confirmpassword)? (App::getMd5($model->confirmpassword)):$prevPassword;        
	       $model->password = ($model->password)?(App::getMd5($model->password)):$prevPassword;

	       //App::printR($model); 

			if($model->save())
			{			
				Yii::$app->session->setFlash('flashSuccess', 'Admin user has been successfully updated.');
				return $this->redirect(['adminuser/#']);
			}
			else
			{
                
				return $this->render('update', [
                'model' => $model,
            ]);
			}
        	
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AppAdmin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete())
        {
			Yii::$app->session->setFlash('flashSuccess', 'Admin User has been successfully deleted.');
        	return $this->redirect(['index']);
    	}
    }

    /**
     * Finds the AppAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AppAdmin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AppAdmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
