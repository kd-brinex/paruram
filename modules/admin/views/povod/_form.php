<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\OtkPovod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otk-povod-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'days')->textInput() ?>

    <?= $form->field($model, 'month')->input('text') ?>

    <?= $form->field($model, 'function')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => 200]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
