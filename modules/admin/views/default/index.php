<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Администраторская';
$this->params['breadcrumbs'][] = $this->title;?>

<div class="admin-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Пользователи', ['/user/admin'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Праздники', ['/admin/povod'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Бланки', ['/admin/image'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Поздравления', ['/admin/text'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
        <div class="col-sx-12">
            <?php
            if (isset($frendpovod)){
                echo GridView::widget([
                    'dataProvider' => $frendpovod['provider'],
                    'filterModel' => $frendpovod['searchModel'],
                    'columns'=>$frendpovod['columns'],
                ]);}?>
        </div>

    </div>
</div>
