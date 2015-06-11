<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\frends\models\Frendpovod */

$this->title = 'Create Frendpovod';
$this->params['breadcrumbs'][] = ['label' => 'Frendpovods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frendpovod-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
