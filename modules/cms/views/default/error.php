<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 14.03.2016
 * Time: 16:10
 */

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-error">
    <div class="col-md-6">
        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>
    </div>
</div>