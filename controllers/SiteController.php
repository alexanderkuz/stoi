<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Forms\ContactForm;
use app\models\ServicesSearch;
use yii\data\ActiveDataProvider;
use app\models\Services;

class SiteController extends Controller
{
    /*public function behaviors()
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
    } */

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



    public function actionIndex()
    {
      /*  $dataProvider = new ActiveDataProvider([
            'query' => Categories::find()->where(['id_parent'=>0]),
            /*'pagination' => [
                'pageSize' => 10,
            ],
            'pagination' => false,
        ]);*/

        $dataProvider = new ActiveDataProvider([
            'query' => Services::find()->where(['active' => Services::ACTIVE,'parent_id'=>0])->orderBy('sort asc'),
            'pagination' => false,
        ]);



        return $this->render('index',[
                'dataProvider'=>$dataProvider,
            ]
        );

    }



    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted','Спасибо за обращение к нам. Мы ответим ближайшее время.');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionServices($id=0)
    {
        return $this->render('services');
    }



}
