<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\frends\models\Frends */

//$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Друзья', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

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
                <?= $this->render('view', [
                'model' => $model,
                'povod'=> $povod,
                ]);?>

            </div>
        </div>
    </div>
</div>