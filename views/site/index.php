<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;




$this->title =  Yii::$app->name;

$this->registerJsFile('js/camera.js');
$this->registerCssFile(Yii::getAlias('@web').'/css/camera.css');
$this->registerJs("$(document).ready(function(){
        jQuery('#camera_wrap').camera({
            loader: false,
            pagination: true ,
            minHeight: '450',
            thumbnails: false,
            height: '43.49593495934959%',
            caption: true,
            navigation: false,
            fx: 'mosaic'
        });
        $().UItoTop({ easingType: 'easeOutQuart' });

    });",View::POS_HEAD ,'camera_wrap');
//'js/camera.js'  'css/camera.css'
?>

<div class="container">

        <?
//<div class="grid_4">
     echo  ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}",
            'itemView' => '_list_services',
         'options' => [
             'id' => false,
             'class'=>'row'

         ],
         'itemOptions'=>
             [
                 'tag'=>false,
             ],
        ]);
        ?>

    </div

</div>
<? /*
    <div class="gray_block">
        <div class="container">
            <div class="row">


                
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

        </div>
    </div>
*/?>




