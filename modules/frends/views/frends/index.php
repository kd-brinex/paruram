<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\frends\models\FrendsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Друзья';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frends-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить Друга', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
//            'bothday:date',
//            'user_id',
//            'email:email',
//            'enable:boolean',
//            'sexname',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
