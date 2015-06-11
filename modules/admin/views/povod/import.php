<?php

use yii\helpers\Html;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OtkPovodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Импорт ICS';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('../ics/_form',['model'=>$model]) ?>
<?php
$files=$model->filelist();
$pathurl=$model->pathurl();
if (isset($files[0])) {
foreach ($files as $index => $file) {
$nameFicheiro = substr($file, strrpos($file, '/') + 1);
echo Html::a($nameFicheiro,'icsfile?file='.$nameFicheiro);
}
} else {
echo "There are no files available for download.";}?>

<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
////            'id',
//            'name',
//            'days',
//            'month',
//            'function',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>

