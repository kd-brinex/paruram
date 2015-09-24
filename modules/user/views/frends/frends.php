<?php
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 23.03.15
 * Time: 12:13
 */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;


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
                        <?php
//                         Html::a('Импорт', ['import'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?php \yii\widgets\Pjax::begin(); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                        [
                                'attribute' => 'bothday',
                                'format' => 'date',
                            ],
                            [
                                'attribute' => 'name',
                                'format' => 'text',
                            ],
                            [
                              'attribute'  => 'email',
                                'format'=>'email',
                            ],
                            [
                              'attribute'  => 'valid',
                                'format'=>'boolean',

                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                'buttons' => [
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
