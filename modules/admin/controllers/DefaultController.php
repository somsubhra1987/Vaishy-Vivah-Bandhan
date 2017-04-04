<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\admin\models\AdminLoginForm;
use app\models\LoginForm;
use app\lib\core\App;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->actionLogin();
    }
    
    public function actionLogin()
    {
	    $this->layout = "@app/web/themes/backend/default/templates/Login/Page";
	    
        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->getHomeUrl() . "admin/dashboard");
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        
//         Yii::$app->session->remove('loggedAdminID');
		Yii::$app->session->removeAll();

        return $this->redirect(Yii::$app->getHomeUrl() . "admin");
    }
}
