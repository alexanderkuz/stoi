<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="container">
    <div class="row">

            <h3><?= Html::encode($this->title) ?></h3>

            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>

    </div>
</div>


