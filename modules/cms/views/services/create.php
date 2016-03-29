<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Services */

$this->title = Yii::t('app', 'Create Services');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
