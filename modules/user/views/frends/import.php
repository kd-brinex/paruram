<?php
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 23.03.15
 * Time: 12:13
 */
use yii\helpers\Html;
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $profile
 */

//$this->title = Yii::t('user', 'Друзья');
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
                <?php
//                var_dump($frends);die;
                    foreach($frends as $frend){
//                        var_dump($frend->bdate);die;
                        $frend['bdate']=(isset($frend['bdate']))?$frend['bdate']:'';
                        echo '<div class="row">';
                        echo '<div class="col-sm-2 col-xs-3">'.Html::img($frend['photo_50']).'</div>';
                        echo '<div class="col-sm-2 col-xs-3">'.$frend['first_name'].'</div>';
                        echo '<div class="col-sm-2 col-xs-3">'.$frend['last_name'].'</div>';
                        echo '<div class="col-sm-1 hidden-xs">'.(($frend['sex']==2)?'М':'Ж').'</div>';
                        echo '<div class="col-sm-2 hidden-xs">'.$frend['bdate'].'</div>';
                        echo '<div class="col-sm-2 hidden-xs">'.(($frend['can_write_private_message']==1)?'ЛС':'НЛС').'</div>';
                        echo '<div class="col-sm-1 col-xs-3">'.Html::checkbox('add').'</div>';
                        echo '</div>';



                    }
                ?>


                </div>
            </div>
        </div>
    </div>
</div>
