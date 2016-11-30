<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Services;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = ['label' => $this->title , 'url' => ['index']];


$this->params['breadcrumbs']=Services::getListBreadcrumb($id,$this->params['breadcrumbs']);

?>
<div class="col-md-2">
    <?= $this->render('_menu') ?>
</div>
<div class="col-md-10">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Services'), ['create','id'=>$id], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?
        if($id!=0)
        {
            if ($Services->parent_id!=0)
            {
                echo Html::a(
                    '<span class="glyphicon glyphicon-level-up"></span>'.' '.Yii::t('app','Level up'),
                    Url::toRoute(['/cms/services/','id'=>$Services->parent_id]),
                    ['class'=>'btn-lg'] //data-pjax="0"
                );
            }
            else
            {
                echo Html::a(
                    '<span class="glyphicon glyphicon-level-up"></span>'.' '.Yii::t('app','Level up'),
                    Url::toRoute(['/cms/services/']),
                    ['class'=>'btn-lg'] //data-pjax="0"
                );
            }

        }

        ?>
    </p>
    <?



    \yii\widgets\Pjax::begin([
        'enablePushState'=>FALSE,
        'id' => 'pjax-container',
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id',
                'options'=>['width'=> '52px'],
            ],
            [
                'attribute'=>'type',
                'value'=>function($data)
                {
                    if ($data->type=='catalog')
                    {
                        return Html::a(
                            '<span class="glyphicon glyphicon-folder-close"></span>',
                            Url::toRoute(['/cms/services/','id'=>$data->id]),
                            ['class'=>'btn-lg','data-pjax'=>0]
                        );
                    }
                    else
                    {
                        return '<a class="btn-lg"><span class="glyphicon glyphicon-file"></span></a>';//glyphicon glyphicon-file

                    }
                },
                'format'=>'raw',
                'options'=>['width'=> '68px'],
            ],
            [
               // 'label'=>'Статус',
                'attribute'=>'active',
                'format'=>'raw',
                'value'=>function($data) { return $data->getActiveName(); },
                'options'=>['width'=> '80px'],
            ],
            [
                'label'=>'Сортировка',
                'attribute'=>'sort',//Сортировка
                'options'=>['width'=> '90px'],
            ],


            'created_date:datetime',
            'attribute'=>'updated_date:datetime',
            'name',
            'code',
            /*[
                'attribute'=>'parent_id',
                'value'=>function() use ($root_name) { return $root_name; },
            ],*/

            [
                'attribute'=>'picture',
                'format' => ['image',['width'=>'100px','height'=>'75px',//'alt'=> $key.' картинка'
                ]],//
                'value'=>function($data) { return $data->picture ? '@web'.$data->path_picture.'small'.$data->picture : '@web/uploads/100x75.jpg'; },
                'options'=>['width'=> '118px'],
                'filter'=>'',
            ],

            [
                'attribute'=>'preview_text',
                'format'=>'html',

            ],
          /*  [
                'attribute'=>'detail_text',
                'format'=>'html',

            ],*/
            //  'title',
            //  'keywords',
            //  'description',

            [
                'class' => 'yii\grid\ActionColumn',
                'options'=>['width'=> '62px']],
        ],
    ]); ?>
    <? \yii\widgets\Pjax::end(); ?>


</div>


