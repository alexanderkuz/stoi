<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
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
            'created_at:datetime',
            'updated_at:datetime',
            'username',
            'auth_key',
            'password_hash',
            'email_confirm_token',
            'password_reset_token',
            'email:email',
            [
                'attribute'=>'status',
                'value'=>$model->getStatusName(),
            ],
            'role',
        ],
    ]) ?>

</div>
