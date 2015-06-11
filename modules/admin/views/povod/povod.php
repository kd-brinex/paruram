<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\OtkPovod */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otk-povod-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'name',
//            'days',
//            'month',
            'date:date',
            'description',
        ],
    ]) ?>

</div>
