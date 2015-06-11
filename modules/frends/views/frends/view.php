<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\frends\models\Frends */

$this->title = $model->fullname;
//$this->params['breadcrumbs'][] = ['label' => 'Друзья', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div id="frend-povod">
<div class="frends-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'fullname',
            'psevdoname',
            'bothday:date',
//            'user_id',
            'email:email',
            'enable:boolean',
            'sexname'
        ],
    ]) ?>

</div>
<div class="frend-povod">

    <table class="table">
    <?php
    foreach($povod as $p){
        echo '<tr>
        <td>'.$p['name'].'</td>
        <td>'.
            HTML::checkbox('enable',$p['enable'],['id'=>'povod'.$p['povod_id'],
                'onchange'=>'updateFrendPovod('.$model->id.','.$p['povod_id'].')']).
            '</td></tr>';
    }?>
</table>
    </form>
</div>
    </div>