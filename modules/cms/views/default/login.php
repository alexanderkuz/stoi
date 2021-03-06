<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title =Yii::t('app','Login');
//$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Yii::getAlias('@web').'/css/form.css',['position' => \yii\web\View::POS_HEAD]);

?>
<div class="col-md-12">

<div class="site-login">


    <p><?= Yii::t('app','Please fill out the following fields to login:');?></p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-2 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-11">
                <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>


</div>
        </div>
