<?php

namespace app\modules\cms;
use Yii;

class cms extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\cms\controllers';


    public function init()
    {

        parent::init();

        Yii::$app->errorHandler->errorAction = 'cms/default/error';

    }

}
