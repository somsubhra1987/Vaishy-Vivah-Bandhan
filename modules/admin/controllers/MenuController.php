<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\CmsMenu;
use app\modules\admin\models\CmsMenuSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenuController implements the CRUD actions for CmsMenu model.
 */
class MenuController extends ControllerAdmin
{
    /**
     * Lists all CmsMenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CmsMenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsMenu model.
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
     * Creates a new CmsMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id=false)
    {
        $model = new CmsMenu();
        if($id) $model->parentID = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsMenu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
	    if(CmsMenu::hasSubmenu($id))
	    {
		    Yii::$app->session->setFlash('error', 'Submenu exists under this menu, you can not delete it.');
	    }
	    else
	    {
	    	if($this->findModel($id)->delete())
	    	{
		    	 Yii::$app->session->setFlash('success', 'Menu has been deleted successfully');
	    	}
    	}

        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CmsMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetcontrollerbymodule()
    {
	    $controllerArray = [];
	    $moduleCode = $_REQUEST['moduleCode'];
		$model = new CmsMenu();
		$controllerArray = $model->getModuleControllerAssoc($moduleCode);
		if(count($controllerArray))
		{
			foreach($controllerArray as $key => $data)
			{
				echo "<option value = '$key'>$data</option>";	
			}	
		}
	}
}
