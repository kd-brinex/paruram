<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OtkPovodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Праздники';
$this->params['breadcrumbs'][] = ['label'=>'Администраторская','url'=>['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otk-povod-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать праздник', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Импорт праздника', ['import'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'days',
            'month',
            'function',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
