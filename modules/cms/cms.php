<?php

namespace app\modules\cms;
use Yii;


class cms extends \yii\base\Module
{
    use cmstrait;

    public $controllerNamespace = 'app\modules\cms\controllers';


    public function init()
    {

        parent::init();

        Yii::$app->errorHandler->errorAction = 'cms/default/error';

    }



}
