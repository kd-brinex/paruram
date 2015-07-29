<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
$image_url = "http://paruram.ru" . $image;
$f_image = Yii::$app->basePath . '/web' . $image;
//var_dump($image_url);die;
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>"/>
        <style type="text/css">
            .heading {
                text-transform: capitalize;
                clear: both;
            }

            .blank {
                background-image: url(<?= $message->embed($f_image) ?>);
                width: 320px;
                height: 480px;
                border-color: #000;
                botrder-width: 1px;
                border-style: solid;
                padding: 5px;
                float: left;

            )
            }

            .message {
                font-size: 16px;
                width: 320px;
                height: 480px;
                border-color: #000;
                botrder-width: 1px;
                border-style: solid;
                padding: 5px;
                float: left;
            }

            .footer {
                font-size: 8px;
                color: #212121
            }
        </style>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div>
        <div style="background-image: url(<?= $message->embed($f_image) ?>);
            width: 320px;
            height: 480px;
            border-color: #372806;
            botrder-width: 1px;
            border-style: solid;
            padding: 5px 5px 5px 5px;
            margin-left: 5px;
            margin-top: 5px;
            float:left;
            background-repeat: no-repeat;
            background-position: center;
            border-radius: 15px;">

        </div>
        <div style="font-size: 16px;
            width: 320px;
            height: 480px;
            border-color :#372806;
            botrder-width :1px;
            border-style: solid;
            border-radius: 15px;
            padding: 5px 5px 5px 5px;
            float:left;
            text-align: center;
            margin-left: 5px;
            margin-top: 5px;">
            <h1><?= $prefics . ' ' . $frendname . '!!!' ?></h1>

            <div class="heading">У <?= $thee ?> сегодня праздник!!! <br>"<?= $povodname ?>"</div>
            </br>
            <div style="text-align: left;padding-left:15px;">
                <?= nl2br($text) ?>
            </div>
        </div>
        <div style="clear: both">Поздравление отправленно службой портала <?= \Yii::$app->name ?>, потому, что Ваш друг
            помнит о
            Вас.
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>