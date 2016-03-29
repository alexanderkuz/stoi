<?php

namespace app\modules\cms\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\base\ErrorHandler;
use Yii;
use app\models\Forms\LoginForm;
use yii\filters\VerbFilter;



class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
  public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
             //   'errorAction'=>'error'
            ],

        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAbout()
    {
        return $this->render('index');
    }
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
}
