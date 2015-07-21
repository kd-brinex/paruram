<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Администраторская';
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="admin-default-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Пользователи', ['/user/admin'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Праздники', ['/admin/povod'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Бланки', ['/admin/image'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Поздравления', ['/admin/text'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Разослать', ['/admin/admin/work'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <div class="col-sx-12">
            <?php
            //            var_dump($frendpovod['columns']);die;
            if (isset($frendpovod)) {
                echo GridView::widget([
                    'dataProvider' => $frendpovod['provider'],
                    'filterModel' => $frendpovod['searchModel'],
                    'columns' => [

                        'happyday:date',
                        'povodname',
                        'frendname',
                        'user_id',
                        [
                            'attribute'=>'image',
                            'format' => ['image', ['height' => '50']],

                            'value' => function ($data) {
                                return \Yii::$app->request->BaseUrl . \Yii::$app->params['imagePath'] . $data['povod_id'] . '/' . $data['image'];
                            }
                        ],

                        'text',
                        'isp'
                    ],

                ]);
            } ?>
        </div>

    </div>
</div>
