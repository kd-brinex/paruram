<?php
return [
        'dev'=>[
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=paruram;port=3333;',
            'username' => 'paruram',
            'password' => 'T4X7Q5OgsV',
            'charset' => 'utf8',
                ],
//    'dev' => [
//        'class' => 'yii\db\Connection',
//        'dsn' => 'mysql:host=10.151.0.6;dbname=paruram',
//        'username' => 'paruram',
//        'password' => 'T4X7Q5OgsV',
//        'charset' => 'utf8',
//    ],
    'prod' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=paruram',
        'username' => 'paruram',
        'password' => 'T4X7Q5OgsV',
        'charset' => 'utf8',
    ]

];
