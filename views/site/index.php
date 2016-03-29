<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\Makedir\Makedir;
use yii\web\View;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;



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
    <div class="row">
        <div class="grid_4">
            <img src="/stroiytru/upload/sc/1416715925/thumbnails/1416715925.jpg" alt="" class="img_inner">
            <h3>Обще строительные работы</h3>
            <div>Компания "СтройЮт" предлагает все виды общестроительных работ. Ремонтно-строительная компания "СтройЮт"  проводит демонтаж напольных покрытий любой сложности...</div><br>
            <a href="#" class="btn">подробнее</a>
        </div>

        <div class="grid_4">
            <img src="/stroiytru/upload/sc/1416715925/thumbnails/1416715925.jpg" alt="" class="img_inner">
            <h3>Потолки</h3>
            <div>Компания "СтройЮт" предлагает все виды общестроительных работ. Ремонтно-строительная компания "СтройЮт"  проводит демонтаж напольных покрытий любой сложности... </div><br>

            <a href="#" class="btn">подробнее</a>

        </div>
        <div class="grid_4">
            <img src="/stroiytru/upload/sc/1416715925/thumbnails/1416715925.jpg" alt="" class="img_inner">
            <h3>Стены</h3>
            <div>Компания "СтройЮт" предлагает все виды общестроительных работ. Ремонтно-строительная компания "СтройЮт"  проводит демонтаж напольных покрытий любой сложности... </div><br>
            <a href="#" class="btn">подробнее</a>

        </div>


        <div class="grid_4">
            <img src="/stroiytru/upload/sc/1416715925/thumbnails/1416715925.jpg" alt="" class="img_inner">
            <h3>Обще строительные работы</h3>
            <div>Компания "СтройЮт" предлагает все виды общестроительных работ. Ремонтно-строительная компания "СтройЮт"  проводит демонтаж напольных покрытий любой сложности...</div><br>
            <a href="#" class="btn">подробнее</a>

        </div>
        <div class="grid_4">
            <img src="/stroiytru/upload/sc/1416715925/thumbnails/1416715925.jpg" alt="" class="img_inner">
            <h3>Потолки</h3>
            <div>Компания "СтройЮт" предлагает все виды общестроительных работ. Ремонтно-строительная компания "СтройЮт"  проводит демонтаж напольных покрытий любой сложности... </div><br>

            <a href="#" class="btn">подробнее</a>

        </div>
        <div class="grid_4">
            <img src="/stroiytru/upload/sc/1416715925/thumbnails/1416715925.jpg" alt="" class="img_inner">
            <h3>Стены</h3>
            <div>Компания "СтройЮт" предлагает все виды общестроительных работ. Ремонтно-строительная компания "СтройЮт"  проводит демонтаж напольных покрытий любой сложности... </div><br>
            <a href="#" class="btn">подробнее</a>

        </div>

    </div
</div></div>
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



