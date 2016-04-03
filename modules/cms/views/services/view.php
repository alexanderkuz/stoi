<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Services */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => "<tr><th class='col-md-2'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            'id',
            [
                // 'label'=>'Статус',
                'attribute'=>'type',
            //    'format'=>'raw',
                'value'=>$model->TypeName,

            ],


            //TypeName
            'parent_id',
            [
                // 'label'=>'Статус',
                'attribute'=>'active',
                'format'=>'raw',
                'value'=>$model->ActiveName,

            ],

            'code',
            'name',
            'sort',
            'created_date:datetime',
            'updated_date:datetime',
            [
                'attribute'=>'picture',
                'format' => ['image',['width'=>'100px','height'=>'75px','alt'=>$model->picture ? $model->picture:'100x75.jpg']],
                'value'=>$model->picture ? '@web'.$model->path_picture.'small'.$model->picture : '@web/uploads/100x75.jpg',

            ],
            [
                'attribute'=>'path_picture',
                'value'=>$model->path_picture.$model->picture,//Yii::getAlias('@web')
            ],

            [
                'attribute'=>'preview_text',
                'format'=>'html',

            ],
            [
                'attribute'=>'detail_text',
                'format'=>'html',

            ],
            'title',
            'keywords',
            'description',
        ],
    ]) ?>

</div>
