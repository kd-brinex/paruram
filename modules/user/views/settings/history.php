<?php
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 23.03.15
 * Time: 12:13
 */
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = Yii::t('user', 'История поздравлений ');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
//                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
                        'povod.name',
                        [
                            'attribute'=>'image.imageurl',
                            'format' => ['image',['height'=>'120']],
                        ],
                        'text.text',
                        'happyday:date'
//                        'function',
////            'countImage',
////            'countText',
////            'countFrendPovod',
//                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>