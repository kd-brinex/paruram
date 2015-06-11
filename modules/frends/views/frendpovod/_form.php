<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\frends\models\Frendpovod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frendpovod-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'frend_id')->dropDownList($model->getFrendslist()) ?>

    <?= $form->field($model, 'povod_id')->dropDownList($model->getPovodlist()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
