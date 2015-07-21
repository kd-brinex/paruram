
<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <style type="text/css">
        /*.heading {}*/
        /*.list {}*/
        .message {font-size:16px;color: #0a0a0a}
        .footer {font-size: 8px; color: #212121}
    </style>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
//file_exists($image)?'<img src="'.$message->embed($image).'">':""; ?>
<h1><?= $frendname?></h1>
<b>Поздравляем Вас с праздником "<?=$povodname?>"</b>
</br>
<div class="message">
<?= $text ?>
</div>
<div class="footer">Поздравление отправленно с <?= \Yii::$app->name ?>, потому, что Ваш друг помнит о Вас</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>