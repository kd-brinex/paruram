<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\frends\models\FrendpovodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('/css/frends.css');
$this->title = 'Frendpovods';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="frend-povod">
    <a href="/frends"><div>Друзья</div></a>
<div class="heads">

<!--    <div class="cols">-->
        <?php foreach ($povod_list as $key => $p) {
            echo '<div>' . $p . '</div>';
        } ?>
<!--    </div>-->
</div>

    <?php

    foreach ($frend_list as $fkey => $f) {

        echo '<a href ="'.$f['frendurl'].'"><div class="rows">' . $f['name'] . '</div></a>';
        echo '<div>';
        foreach($povod_list as $pkey=>$p) {
            echo '<div class="values">'.((isset($f['enable'][$pkey]) and $f['enable'][$pkey]>0)?'<div class="yes icon-white"></div>':'<div class="no icon-white"></div>').'</div>';
        }
        echo '<div class="close"></div>';
}
    ?>
</div>
    </div>




