<?php
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 23.03.15
 * Time: 12:13
 */
use yii\helpers\Html;
use yii\grid\GridView;


/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $profile
 */

$this->title = Yii::t('user', 'Друзья');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('../settings/_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <div class="frends-index">
                    <p>
                        <?= Html::a('Добавить Друга', ['create'], ['class' => 'btn btn-success']) ?>
<!--                        --><?//= Html::a('Импорт', ['import'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?php \yii\widgets\Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
//                      'dataColumnClass' => ['class'=>'col-md-2'],
                        'columns' => [
//                            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//                            'name',
//                            [
////                                'class' => DataColumn::className(),
//                                'attribute' => 'name',
//                                'format' => 'text',
//                                'options' => ['class'=>'col-md-1'],
////                                'label' => 'Name',
//                            ],
                            [
                                'attribute' => 'bothday',
                                'format' => 'date',
//                                'options' => ['class'=>'col-xs-2'],
                            ],
                            [
                                'attribute' => 'fullname',
                                'format' => 'text',
//                                'options' => ['class'=>'col-xs-3'],
//                                'label' => 'Name',
                            ],
//                            [
//                                'attribute' => 'providerlogo',
//                                'format' => 'html',
////                                'caption'=>'provider',
////                                'caption' =>  Html::tag('span', '', ['class' => 'auth-icon ' . $client->getName()]),
////                                'label' => 'Name',
//                            ],
//                            [
//                                'attribute' => 'photo',
//                                'format' => 'image',
//                            ],
//            'user_id',
            'email:email',
            'valid:boolean',
//            'sexname',

                            ['class' => 'yii\grid\ActionColumn',
//                                'header'=>'Изменить',
//                                'options' => ['class'=>'col-xs-1'],
                                'buttons' => [
//                                 'view'=>function($url,$model,$key){
//                                return Html::a($model->fullname,'view?id='.$key);
//                             }  ,
                                    'update' => function ($url, $model, $key) {
                                        return '';
                                    },
                                    'delete' => function ($url, $model, $key) {
                                        return '';
                                    },]
                            ],
                        ],
                    ]); ?>
                    <?php \yii\widgets\Pjax::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
