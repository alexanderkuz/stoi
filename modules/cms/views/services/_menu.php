<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 23.03.2016
 * Time: 2:34
 */
use yii\widgets\Menu;
use app\models\Services;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?=Yii::t('app','Sections')?>:</h3>
    </div>
    <div class="panel-body">
        <div class="row">
<?
echo Menu::widget([
    'options'=>['class'=>'nav nav-pills nav-stacked ','style'=>'font-size:12px;'],//background-color: #f5f5f5;  border: 1px solid #e3e3e3;background-color: #f5f5f5;
    'submenuTemplate'=>'<ul class="nav nav-pills nav-stacked" style="padding-left: 20px">{items}</ul>',
    'items' =>Services::getListMenu()

]);

?>
        </div>
    </div>
</div>
