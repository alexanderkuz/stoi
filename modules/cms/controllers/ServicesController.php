<?php

namespace app\modules\cms\controllers;

use Yii;
use app\models\Services;
use app\models\ServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\web\UploadedFile;

use app\components\Makedir\Makedir;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;


/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [


                    [
                        // 'actions'=>['create','index'],
                        'allow' => true,
                        'roles' => ['moderator'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Services models.
     * @return mixed
     */
    public function actionIndex($id=0)
    {
        if ($id==0)
        {
            $count=1;
        }
        else
        {
            $count=Services::find()->where(['id'=>$id,'type'=>'catalog'])->count();
        }
        if ($count!=0)
        {
            $searchModel = new ServicesSearch();
            $dataProvider = $searchModel->search2(Yii::$app->request->queryParams,$id);
            $Services=Services::getParentID($id);


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id'=>$id,
                'Services'=>$Services
            ]);
        }
        else
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
    }

    /**
     * Displays a single Services model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Services model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Services();

        if ($model->load(Yii::$app->request->post()))
        {
            $imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($imageFile && $imageFile->tempName)
            {
                $model->imageFile=$imageFile;
                if ($model->validate(['imageFile']))
                {
                    $makedir=new Makedir($imageFile->name,Yii::getAlias('@webroot'),'uploads/services','Y m d');
                    $file=Yii::getAlias('@webroot').$makedir->GetResult()['path'] . $makedir->GetResult()['file'];
                    $model->imageFile->saveAs($file);
                    $model->picture=$makedir->GetResult()['file'];
                    $model->path_picture=$makedir->GetResult()['path'];
                    $model->imageFile=$makedir->GetResult()['file'];

                    Image::thumbnail($file,100,75)
                        ->save(Yii::getAlias('@webroot').$makedir->GetResult()['path'] .'small'. $makedir->GetResult()['file'], ['quality' => 80]);

                    Image::thumbnail($file,370,278)
                        ->save(Yii::getAlias('@webroot').$makedir->GetResult()['path'] .'thumb'. $makedir->GetResult()['file'], ['quality' => 80]);

                    Image::thumbnail($file,1024,768)
                        ->save(Yii::getAlias('@webroot').$makedir->GetResult()['path'] .'big'. $makedir->GetResult()['file'], ['quality' => 80]);

                }
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                $model->loadDefaultValues();
                $model->parent_id=$id;
                return $this->render('create', [
                    'model' => $model,
                    'id'=>$id,
                ]);
            }

        } else {
            $model->loadDefaultValues();
            $model->parent_id=$id;
            return $this->render('create', [
                'model' => $model,
                'id'=>$id,
            ]);
        }
    }

    /**
     * Updates an existing Services model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
            $imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($imageFile && $imageFile->tempName)
            {
                $model->imageFile=$imageFile;
                if ($model->validate(['imageFile']))
                {
                    $makedir=new Makedir($imageFile->name,Yii::getAlias('@webroot'),'uploads/services','Y m d');
                    $file=Yii::getAlias('@webroot').$makedir->GetResult()['path'] . $makedir->GetResult()['file'];
                    $model->imageFile->saveAs($file);
                    $model->picture=$makedir->GetResult()['file'];
                    $model->path_picture=$makedir->GetResult()['path'];
                    $model->imageFile=$makedir->GetResult()['file'];

                    Image::thumbnail($file,100,75)
                        ->save(Yii::getAlias('@webroot').$makedir->GetResult()['path'] .'small'. $makedir->GetResult()['file'], ['quality' => 80]);

                    Image::thumbnail($file,370,278)
                        ->save(Yii::getAlias('@webroot').$makedir->GetResult()['path'] .'thumb'. $makedir->GetResult()['file'], ['quality' => 80]);

                    Image::thumbnail($file,1024,768)
                        ->save(Yii::getAlias('@webroot').$makedir->GetResult()['path'] .'big'. $makedir->GetResult()['file'], ['quality' => 80]);

                }
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                $model->loadDefaultValues();
                $model->parent_id=$id;
                return $this->render('create', [
                    'model' => $model,
                    'id'=>$id,
                ]);
            }

        }  else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Services model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);

        Services::updateAll(['parent_id' => $model->parent_id], 'parent_id=:parent_id', [':parent_id'=>$model->id]);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Services model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Services the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Services::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
    }
}
