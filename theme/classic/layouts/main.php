<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

use yii\widgets\Menu;
//use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;

AppAsset::register($this);
//$this->registerJsFile('js/camera.js',['position'=>View::POS_END]);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="icon" href="<?= Yii::getAlias('@web'); ?>/images/favicon.ico">
    <link rel="shortcut icon" href="<?= Yii::getAlias('@web'); ?>/images/favicon.ico">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body <? if ((Yii::$app->controller->action->id=='index') and (Yii::$app->controller->id=='site')) { ?> class="page1" <? } ?> id="top">
<?php $this->beginBody() ?>

<div class="main">
    <header>
        <div class="container">
            <div class="row">
                <div class="grid_12">
                    <h1>
                        <a href="<?= Yii::$app->homeUrl; ?>">
                            <img src="<?= Yii::getAlias('@web'); ?>/images/logo.png" alt="logos"></a>
                    </h1>
                    <div class="menu_block">
                        <nav class="horizontal-nav full-width horizontalNav-notprocessed">
                            <? echo Menu::widget([

                                'options' =>['class'=>'sf-menu sf-js-enabled sf-arrows'],
                                'activeCssClass'=>'current',
                                 'items' => [
                                     ['label'=>'Главная', 'url'=>['/site/index']],
                                     ['label'=>'Услуги и цены', 'url'=>['/site/services']],
                                     ['label'=>'Наши работы', 'url'=>['/site/portfolio']],
                                     ['label'=>'Вопросы и ответы', 'url'=>['/site/faq']],
                                     //  ['label'=>'Статьи', 'url'=>['/site/about']],
                                     ['label'=>'Вакансии', 'url'=>['/site/vacancies']],
                                     ['label'=>'Контакты', 'url'=>['/site/contact']],

                                     !Yii::$app->user->isGuest ?
                                         [
                                             'label' => 'CMS',
                                             'url' => ['/cms'],
                                         ]: '',

                                     // Important: you need to specify url as 'controller/action',
                                     // not just as 'controller' even if default action is used.

                                 ],
                             ]);
                            ?>
                        </nav>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </header>
    <? if ((Yii::$app->controller->action->id=='index') and (Yii::$app->controller->id=='site'))
    {
    ?>
        <div class="slider_wrapper ">
            <div id="camera_wrap" class="">
                <div data-src="<?= Yii::getAlias('@web'); ?>/images/slide.jpg" >
                    <div class="caption fadeIn">
                        <h2>Мы Строим Уют в том месте,<br>которое Вы называете - Дом
                        </h2>
                       <? // <a href="#">Подробнее</a> ?>
                    </div>
                </div>
                <div data-src="<?= Yii::getAlias('@web'); ?>/images/slide1.jpg" >
                    <div class="caption fadeIn">
                        <h2>Мы Строим Уют в том месте,<br>которое Вы называете - Дом</h2>
                        <? // <a href="#">Подробнее</a> ?>
                    </div>
                </div>
                <div data-src="<?= Yii::getAlias('@web'); ?>/images/slide3.jpg" >
                    <div class="caption fadeIn">
                        <h2>Мы Строим Уют в том месте,<br>которое Вы называете - Дом</h2>
                        <? // <a href="#">Подробнее</a> ?>
                    </div>
                </div>
            </div>
        </div>

    <?
    }
    ?>



    <!--==============================Content=================================-->
    <div class="content">
        <?php echo $content; ?>
    </div>




</div>
<!--==============================footer=================================-->

<footer>
    <div class="container">
        <div class="row">
            <div class="grid_12">
                <div class="socials">
                    <a href="#"></a>
                    <a href="#" class="soc1"></a>
                    <a href="#" class="soc2"></a>
                    <a href="#" class="soc3"></a>
                </div>
                <div class="copy"><span class="col1">StroiYT</span>  © <span id="copyright-year"><?= date('Y') ?></span>  <div></div>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
