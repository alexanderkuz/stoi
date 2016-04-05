<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //public $cssOptions = ['condition' => '(gt IE 9)|!(IE)'];

    public $css = [
        'css/style.css',

    ];

    public $js = [
     //   'js/jquery.min.js',
        'js/jquery-migrate-1.1.1.js',
        'js/script.js',
        'js/superfish.js',
        'js/jquery.equalheights.js',
        'js/jquery.easing.1.3.js',
        'js/jquery.mobilemenu.js',
        'js/jquery.ui.totop.js',

        //camera
    ];
    public $depends = [
        'yii\web\YiiAsset',
      //  'yii\bootstrap\BootstrapAsset', YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
        'app\assets\Ie9Asset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
