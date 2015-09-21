<?php
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 06.08.15
 * Time: 18:53
 */
use yii\helpers\Html;


?>
<div class="container">
    <div class = "row">
        <div style="font-size: large;text-align: center">
        Добрый день. Я рад приветствовать Вас на сайте paruram.ru. </br>
            У всех нас есть друзья или знакомые с которыми мы бы не хотели терять связь. Но за нехваткой времени, расстояний или собственной лени мы очень редко видимся. Поэтому было решено создать небольшой сервис который бы поздравлял людей с праздниками. Пройдите регистрацию и ... хотябы просто пройдите регистрацию)))

        </div>

    </div>
    <div class="row">

        <div class="col-xs-12 col-md-6">
           <?= Html::a(yii\bootstrap\Button::widget([
               'label' => 'Я хочу пройти регистрацию.',
               'options' => [
                   'class' => 'btn btn-success btn-block',
//                    'style' => 'align:center'
               ]]),yii\helpers\Url::to('user/register'))?>
        </div>


        <div class="col-xs-12 col-md-6">
            <?= Html::a(yii\bootstrap\Button::widget([
                'label' => 'Я уже зарегистрированный пользователь.',
                'options' => [
                    'class' => 'btn btn-primary btn-block',
//                    'style' => 'align:center'
                ]]),yii\helpers\Url::to('user/login'))?>
        </div>

    </div>
</div>