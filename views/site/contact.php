<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = Yii::t('app','Contact');

$this->registerJsFile('http://api-maps.yandex.ru/2.1/?load=package.full&lang=ru_RU',['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile(Yii::getAlias('@web').'/css/form.css',['position' => \yii\web\View::POS_HEAD]);

$str=0;
?>
<script>
    ymaps.ready(init);

    var myMap,
        bigMap = false;

    function init () {
        myMap = new ymaps.Map('map', {
            center: [55.678798, 37.893508],
            zoom: 12,
            controls: ['zoomControl',  'typeSelector',  'fullscreenControl']
        }, {

            autoFitToViewport: 'always'
        });
        $('#toggler').click(toggle);
    }

    function toggle () {
        bigMap = !bigMap;


        if (bigMap) {
            $('#map').removeClass('smallMap');
        } else {
            $('#map').addClass('smallMap');
        }


        if ($('#checkbox').attr('checked')) {
            myMap.container.fitToViewport();
        }
    }
</script>
<div class="container">
    <div class="row">
        <div class="grid_12">
            <h3><?=$this->title?></h3>
            <?php if(Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
            <div id="form">
                <div class="success_wrapper"">
                <div class="success-message"><?=Yii::$app->session->getFlash('contactFormSubmitted'); ?></div>
            </div>
        </div>


        <?php endif; ?>
        <div class="map" >
            <figure id="map"></figure>
            <div class="hor"></div>
        </div>
    </div>

    <div class="clear"></div>

    <div class="grid_4">

        <h3>Адрес</h3>

        <div class="map">
            <address><!--  <dt class="text1 col1">
          8901 Marmora Road,<br>
           Glasgow, D04 89GR.
          </dt>
     +7 (919) 108 37 36
    +7 (909) 927 94 23
    -->
                <p>Телефоны:+7 (919) 108 37 36</p>

                <p>+7 (909) 927 94 23</p>
            </address>
        </div>

    </div>

    <div class="grid_8">
        <h3>Форма обратной связи</h3>

        <?php $form = ActiveForm::begin([
            'id' => 'form',
            'errorCssClass'=>'',

            //'options' => ['errorCssClass'=>'error-message',],
            'fieldConfig' => [
                'template' => "{input}\n{error}",
                //'tag'=>false,
                'options'=> [           'tag'=>'label',

                    //    'template' => "{input}\n{error}",
                ],'errorOptions' => ['class' => 'error-message'],
                //'labelOptions' => ['class' => 'col-lg-2 control-label'],
                //   'errorMessageCssClass'=>'error-message'

            ],

        ]); ?>

        <?= $form->field($model, 'name')->textInput(['placeholder' => 'ФИО*:']) ?>

        <?= $form->field($model, 'email')->input('email',['placeholder' => 'Email*:']) ?>

        <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+7-999-999-99-99',

            'options'=>['placeholder'=>'phone*:' ],
        ]) ?>

        <?= $form->field($model, 'body',['options'=> ['class'=>"message"]])->textarea(['placeholder' => 'Текст сообщения*:']) ?>


        <div>
            <div class="clear"></div>
            <div class="btns">

                <?= Html::submitInput('Отправить', ['class' => 'btn'] ) ?>
                <span>* - Необходимо заполнить поля</span>
            </div>


        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>

