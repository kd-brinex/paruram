<?php
/* @var $this yii\web\View */
$this->title = 'Парурам';
use yii\grid\GridView;
use yii\bootstrap\Alert;
//var_dump($userid);die;
?>
<div class="site-index">

    <div class="body-content">




        <div class="row">
            <div class="col-sx-12">
        <?php
        if (isset($frendpovod)){
        echo GridView::widget([
            'dataProvider' => $frendpovod['provider'],
            'columns'=>$frendpovod['columns'],
        ]);}?>
            </div>

        </div>


</div>


</div>
