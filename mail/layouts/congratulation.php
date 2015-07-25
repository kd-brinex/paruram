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
            background-image: url("<?= $image_url?>");
            width: 640px;
            height: 480px;
            border-color: #000;
            botrder-width: 1px;
            border-style: solid;
            padding: 5px;
        )
        }

        .message {
            font-size: 16px;
            color: #0a0a0a
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
    <div style="background-image: url(<?= $message->embed($f_image) ?> ) ;
        background-repeat: no-repeat;
        width: 320px;
        height: 480px;
        border-color :#000;
        botrder-width :1px;
        border-style: solid;
        padding: 5px;
        float:left">
    </div>
    <div style="

        height: 480px;
        border-color :#000;
        botrder-width :1px;
        border-style: solid;
        padding: 5px;
        float:left;">
        <h1><?= $frendname ?></h1>

        <div class="heading">Поздравляем <?= $thee ?> с праздником "<?= $povodname ?>"</div>
        </br>
        <div class="message">
            <?= $text ?>
        </div>
    </div>
    <div class="footer">Поздравление отправленно службой портала <?= \Yii::$app->name ?>, потому, что Ваш друг помнит о
        Вас.
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>