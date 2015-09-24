<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\modules\frends\models\Frends */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frends-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => 45]) ?>
    <?= $form->field($model, 'sex')->dropDownList([1=>'женский',2=>'мужской']) ?>
    <?= $form->field($model,'bothday')->widget(DatePicker::className(),[
        'language' => 'ru',
	'dateFormat' => 'dd.MM.yyyy',
        'clientOptions' =>[
        'dateFormat' => 'yyyy-MM-dd',
//        'language' => 'RU',
//      'country' => 'IN',
        'showAnim'=>'fold',
        'yearRange' => '1920:2020',
        'changeMonth'=> true,
        'changeYear'=> true,
        'autoSize'=>true,
        'showOn'=> "button",
        //'buttonImage'=> "images/calendar.gif",
        'htmlOptions'=>[
        'style'=>'width:80px;',
        'font-weight'=>'x-small',
    ]]])?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->getId()])->label(false) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'enable')->checkbox() ?>

    <?= $form->field($model, 'nati')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
