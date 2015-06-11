<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\frends\models\Frends */

$this->title = 'Create Frends';
$this->params['breadcrumbs'][] = ['label' => 'Frends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frends-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
