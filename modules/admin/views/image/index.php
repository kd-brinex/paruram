<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бланки';
$this->params['breadcrumbs'][] = ['label'=>'Администраторская','url'=>['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Image', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute'=>'imageurl',
                'format' => ['image',['height'=>'25']],
            ],
            'title',
            'povodname',

//            [
//                'attribute'=>'povod_id',
//                'value'=>function($data){return $data->povodname;},
//            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
