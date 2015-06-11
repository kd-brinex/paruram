<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\frends\models\Frendpovod */

$this->title = 'Update Frendpovod: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Frendpovods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="frendpovod-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
