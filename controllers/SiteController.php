<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UserMaster;
use app\models\UserMessage;
use yii\web\UploadedFile;
use app\lib\Core;
use app\lib\CustomFunctions;
use app\lib\Sms;
use app\lib\VEmail;
use yii\web\NotFoundHttpException;

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
			$response['country'] = $model->country;
			if($model->phoneNo != '' && strlen($model->phoneNo) == 10 && $model->country == '1')
			{
				$smsObj = new Sms();
				$curlResponse = $smsObj->sendSms($model->phoneNo, 91, 'afterRegistration');
				$curlResponseArr = json_decode($curlResponse, true);
				
				$smsModel = new UserMessage();
				$smsModel->mobileNumber = $model->phoneNo;
				$smsModel->messageBody = $curlResponseArr[1];
				$smsModel->apiResponse = $curlResponseArr[0];
				$smsModel->save();
			}
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
        if ($model->load(Yii::$app->request->post())) {
			if($model->contact(Yii::$app->params['adminEmail']))
			{
            	Yii::$app->session->setFlash('success', 'Successfully Sent');
			}
			else
			{
				Yii::$app->session->setFlash('warning', 'Not Sent');
			}

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
	
	/**
     * Displays testimonal page.
     *
     * @return string
     */
    public function actionTestimonial()
    {
        return $this->render('testimonial');
    }
	
	/**
     * Displays service page.
     *
     * @return string
     */
    public function actionService()
    {
        return $this->render('service');
    }

    public function actionStateagainstcountry($countryID)
    {
        $stateData = CustomFunctions::getStateAssoc($countryID);
        return json_encode($stateData);
    }
	
	public function actionForgotpassword($emailId)
	{
		$userModel = UserMaster::findOne(['email' => $emailId]);
		if($userModel->profileID != '')
		{
			$randNumber = rand(1111, 999999);
			$userModel->forgotPasswordKey = $randNumber;
			$userModel->isForgotPasswordKeyExpired = 0;
			$userModel->save();
			
			VEmail::sendForgotPasswordMail($emailId, $userModel->profileID, $randNumber);
			return json_encode(array('status' => 'success', 'message' => 'Password Reset Link has been sent to your email'));
		}
		else
		{
			return json_encode(array('status' => 'error', 'message' => 'This email id is not registered with us'));
		}
	}
	
	public function actionResetpassword($emailID, $profileID, $forgotPasswordKey)
	{
		$this->layout = "@app/web/themes/frontend/vivahBandhan/templates/Login/Page";
		
		$model = new UserMaster();
		$userStatus = 0;
		$userDetail = UserMaster::findOne(['email' => $emailID, 'isForgotPasswordKeyExpired' => 0]);
		if($userDetail->profileID != '')
		{
			$userStatus = 1;
		}
		
        if($model->load(Yii::$app->request->post()))
        {
			$userModel = $this->findUserModel($userDetail->userID);
			$userModel->scenario = 'reset_password';
			if($model->newPassword != $model->confirmPassword)
			{
				Yii::$app->session->setFlash('error', '<div class="text-red">Confirm Password Mismatch</div>');
			}
			else
			{
				$userModel->newPassword = $model->newPassword;
				$userModel->confirmPassword = $model->confirmPassword;
				$userModel->userPassword = $model->confirmPassword;
				$userModel->isForgotPasswordKeyExpired = 1;
				
				$response = array();
				if ($userModel->save()) {
					Yii::$app->session->setFlash('success', '<div class="text-green">Password changed Successfully</div>');
					return $this->redirect(['site/login']);
				}
				else{
					Yii::$app->session->setFlash('error', Core::createErrorlist($userModel->getErrors()));
				}
			}
        }
        
        return $this->render('resetpassword', [
            'model' => $model,
			'emailID' => $emailID,
			'profileID' => $profileID,
			'forgotPasswordKey' => $forgotPasswordKey,
			'userStatus' => $userStatus,
        ]);
	}
	
	protected function findUserModel($id)
    {
        if (($model = UserMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
