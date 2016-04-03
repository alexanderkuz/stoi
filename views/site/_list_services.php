<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 03.04.2016
 * Time: 1:32
 */
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="grid_4">
    <?= Html::img('@web'.$model->path_picture.'thumb'.$model->picture, ['alt'=>Html::encode($model->name), 'class'=>'img_inner','width'=>'100%','height'=>'100%']); ?>
    <h3><?= Html::encode($model->name) ?></h3>
    
    <div><?= $model->preview_text ?>...</div><br>
    <?= Html::a('подробнее',['/services','id'=>$model->id],['class'=>'btn']) ?>
</div>

