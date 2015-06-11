<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Image */

$this->title = 'Update Image: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Бланки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование бланка';
?>
<div class="image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
