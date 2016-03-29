<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
//use app\assets\AppAsset;
use app\modules\cms\assets\CmsAsset;
use yii\widgets\Breadcrumbs;

$Bundle=CmsAsset::register($this);
?>
<?php $this->beginPage() ?><!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['namesite'],
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions'=>['class'=>'container-fluid'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],

            ['label' => 'CMS Index', 'url' => ['/cms/default/index']],
            ['label' => Yii::t('app','Users'), 'url' => ['/cms/user/index']],
            ['label' => Yii::t('app','Services'), 'url' => ['/cms/services/index']],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?= Breadcrumbs::widget([
                    'homeLink' => ['label' => 'CMS', 'url' => ['default/index']],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <h1><?= Html::encode($this->title) ?></h1>
            </div>

        <?= $content ?>

        </div>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>


    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
