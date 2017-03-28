<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UserMaster;
use yii\web\UploadedFile;
use app\lib\Core;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "@app/web/themes/frontend/vivahBandhan/templates/Home/Page";
        $model = new UserMaster();
        if ($model->load(Yii::$app->request->post())) {
            $model->fileName=UploadedFile::getInstance($model, 'fileName');
            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'Profile successfully created and Password has been sent to your mail please check..'); 
                return $this->redirect(['index']);
            }            
        }
        return $this->render('index',[
            'model'=>$model,
        ]);
    }

    public function actionRegister()
    {
        $response = array();
        $model = new UserMaster();
        $model->scenario = 'registration';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $response['success'] = 1; 
            $response['message'] = 'Profile successfully created and Password has been sent to your mail please check..';
            exit(json_encode($response));
        }
        else{
           // print_r($model->getErrors());
            $response['success'] = 0; 
            $response['message'] = Core::createErrorlist($model->getErrors());
            exit(json_encode($response));
        }   
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = "@app/web/themes/frontend/vivahBandhan/templates/Login/Page";        
        $model = new LoginForm();
        if(Yii::$app->request->post())
        {
            $response = array();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $response['success'] = 1; 
            $response['redirectUrl'] = Yii::$app->urlManager->createUrl(['/member']);
            }
            else{
            $response['success'] = 0; 
            $response['message'] = Core::createErrorlist($model->getErrors());            
            }
            exit(json_encode($response));
        }
        
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['login']);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
