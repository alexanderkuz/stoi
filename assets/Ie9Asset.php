<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 15.03.2016
 * Time: 14:50
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Ie9Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $css = [

    ];

    public $js = [
        'js/jquery.mobile.customized.min.js',
    ];
    public $jsOptions = ['condition' => '(gt IE 9)|!(IE)'
    ,'position' => \yii\web\View::POS_HEAD];
}
