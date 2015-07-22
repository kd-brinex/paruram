<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Image */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data','method'=>'post']]); ?>

    <?=($model->image)?Html::img($model->imageurl,['height'=>'200px']):''?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 250]) ?>

    <?php
//    $form->field($model, 'povod_id')->hiddenInput();
//
//     $form->field($model, 'image')->hiddenInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
