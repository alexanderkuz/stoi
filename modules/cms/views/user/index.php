<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;//111123
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute'=>'status',
                'value'=>function($data){
                    return $data->getStatusName();
                },
            ],
            'role',
            'username',
          //  'auth_key',
            // 'password_hash',
            // 'email_confirm_token:email',
            // 'password_reset_token',
             'email:email',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
