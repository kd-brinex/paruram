<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 28.07.15
 * Time: 18:33
 */
echo GridView::widget([
    'dataProvider' => $dataProvider,
//    'filterModel' => $frendpovod['searchModel'],
    'columns' => [

        [
            'attribute'=>'name',
            'label'=>'Праздник',
        ],
        [
            'attribute'=>'blank_count',
            'label'=>'Необходимо бланков',

        ],
        [
            'attribute'=>'image_count',
            'label'=>'Рисунков',
            'format'=>'raw',
            'value' => function ($data) {
                $need=$data['blank_count']-$data['image_count'];
                $a=($need>0)?Html::a(' (не хватает-'.$need.')',Url::to(['image/create','povod_id'=>$data['povod_id']])):'';
                $html='<span>Всего - '.$data['image_count'].'</span>'.$a;
                return $html;
            }
        ],
        [
            'attribute'=>'text_count',
            'label'=>'Поздравлений',
            'format'=>'raw',
            'value' => function ($data) {
                $need=$data['blank_count']-$data['text_count'];
                $a=($need>0)?Html::a(' (не хватает-'.$need.')',Url::to(['text/create'])):'';
                $html='<span>Всего - '.$data['text_count'].'</span>'.$a;
                return $html;
            }
        ],
    ],

]);