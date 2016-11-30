<?php
//use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use dosamigos\ckeditor\CKEditor;


use mihaildev\ckeditor\CKEditor;

use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Services */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'type')->dropDownList($model->getTypesArray()) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($model::getParentsListAll($model->id),['prompt' => Yii::t('app','Root')]) ?>

    <?= $form->field($model, 'active')->dropDownList($model->getActivesArray()) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <? if (!$model->isNewRecord) {?>
    <?= $form->field($model, 'created_date')->textInput() ?>
    <? }?>

    <? if (!$model->isNewRecord) {?>
        <?= $form->field($model, 'picture')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'path_picture')->hiddenInput()->label(false) ?>
    <? }?>
    <?
   // $model->picture='100x75.jpg';
   // $model->path_picture='@web/uploads/';
    if (($model->isNewRecord) or empty($model->picture))
    {
        $file= Html::img('@web/uploads/100x75.jpg', ['alt'=>'100x75', 'style'=>'width: auto; height: auto;']);
    }
    else
    {

        $file=  Html::img('@web'.$model->path_picture.'small'.$model->picture, ['alt'=>'100x75', 'style'=>'width: auto; height: auto;']);
    }
        ?>
    <?= $form->field($model, 'imageFile', [
            'template' => "{label}\n<div><label>".$file."</label></div>{input}\n{hint}\n{error}"
])->fileInput() //imageFile?>

    <?


    ?>




    <?/*= $form->field($model, 'preview_text')->widget(CKEditor::className(), [
        // 'options' => ['rows' => 6],
        'preset' => 'basic',
        'clientOptions'=>[
            'enterMode' => 2,
            'filebrowserImageUploadUrl'=> Yii::getAlias('@web')."/uploads/iaupload.php"
            //'tags'=>'<br>'
        ],
    ]); */?>

    <?= $form->field($model, 'preview_text')->widget(CKEditor::className(), [
        // 'options' => ['rows' => 6],
        'editorOptions'=>ElFinder::ckeditorOptions(['elfinder'],
            [
                'preset' => 'basic',
            ]),
    ]); ?>

    <?/*= $form->field($model, 'detail_text')->widget(CKEditor::className(), [
        // 'options' => ['rows' => 6],
        //'preset' => 'basic',
        'clientOptions'=>[
            //'enterMode' => 2,
            'filebrowserImageUploadUrl'=> Yii::getAlias('@web')."/uploads/iaupload.php"
            //'tags'=>'<br>'
        ],
    ]); */?>

    <?= $form->field($model, 'detail_text')->widget(CKEditor::className(), [
        // 'options' => ['rows' => 6],
        'editorOptions'=>ElFinder::ckeditorOptions(['elfinder'],
            [/* Some CKEditor Options */
                'preset' => 'full',
            ]),

        /*'clientOptions'=>[
          //  'dir' => '/old',
            //'uploadDir'=>Yii::getAlias('@frontend/web/old'),
           // 'extraPlugins' => 'imageuploader',
            'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[/* Some CKEditor Options */
        //]),
        // 'enterMode' => 1,
        //   'filebrowserImageBrowseUrl' => $kcfinderUrl . '/browse.php?opener=ckeditor&type=images&dir=/old',
        //  'filebrowserImageUploadUrl' => $kcfinderUrl . '/upload.php?opener=ckeditor&type=images&dir=/old',
        //'filebrowserImageUploadUrl'=> Yii::getAlias('@web')."/uploads/iaupload.php"
        //'tags'=>'<br>'

        //  ],*/
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
