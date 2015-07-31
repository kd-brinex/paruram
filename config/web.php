<?php

$params = require(__DIR__ . '/params.php');
$db=require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
//    'bootstrap' => ['log'],
    'name'=>'Paruram.ru',
    'bootstrap' => [
        'app\modules\user\Bootstrap',
    ],
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
//                'google' => [
//                    'class' => 'yii\authclient\clients\GoogleOpenId'
//                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '1830219113870288',
                    'clientSecret' => '0eadcf59b50549c58d85a5ae3e658c7e',
                ],
                'vkontakte' => [
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => '4825443',
                    'clientSecret' => 'irjJYtU3Z9i2CwXe4Pg7',
                ],
                'odnoklassniki' => [
                    'class' => 'app\modules\authclient\clients\Odnoklassniki',
                    'clientId' => '1133671680',
                    'clientSecret' => 'B92D96C63E62CEEF5C0B96BF',

                    'clientKey' => 'CBAGHDJEEBABABABA',
                ],
//                'twitter'=>[
//                  'class'=>'yii\authclient\clients\Twitter',
//                ],
//                'yandex'=>[
//                    'class'=>'yii\authclient\clients\YandexOpenId',
//                ],
            ],
        ],
        'urlManager'=>[
            'enablePrettyUrl'=>true,
            'showScriptName'=>false,
            'suffix'=>'',
            'rules'=>[
                ''=>'site/index',
//            ''=>'frends/frendpovod/listall',
                'profile' => 'user/settings/profile',
                'login'=>'user/security/login',
                'register'=>'user/registration/register',
                'about'=>'site/about',
                'contact'=>'site/contact',
                'gii'=>'gii/index',
                'frends'=>'frends/frends',
                'frend/<id:\w+>'=>'user/frends/view',
                'frendpovod'=>'frends/frendpovod',
                'pupdate'=>'frends/frends/pupdate',
                'povod/<id:\d+>'=>'admin/povod/povod',
                'blank/<id:\d+>'=>'admin/image/blank',
                'admin'=>'admin/admin',


//                'icsfile/<file:\w+>'=>'admin/povod/povod/icsfile',

		'amp'=>'/amp/index.php',
            ]
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
//            'useFileTransport' => true,
//            'fileTransportPath' => '@runtime/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mail.ru',//'smtp.gmail.com',
                'username' => 'happy@paruram.ru',
                'password' => 'q2@4dQjdiAIM',
                'port' => '465',
                'encryption' => 'ssl',

            ],
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.gmail.com',//'smtp.gmail.com',
//                'username' => 'maratjobmail@gmail.com',
//                'password' => 'HuMa250773-gmail',
//                'port' => '587',
//                'encryption' => 'tls',
//            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
//            'cookieValidationKey' => 'jhuygAs87Lokmhbt6fdrWsAQ',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'view' => [
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    // set cachePath to false in order to disable template caching
                    'cachePath' => '@runtime/Twig/cache',
                    // Array of twig options:
                    'options' => [
                        'auto_reload' => true,
                    ],

                ],
            ],
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views/settings' => '@app/modules/user/views/settings',
                    '@dektrium/user/views/frends' => '@app/modules/user/views/frends',
                    '@app/modules/user/views/frends' => '@app/modules/frends/views/frends',
                    '@dektrium/user/views/security' => '@app/modules/user/views/security',
                    '@dektrium/user/views/registration' => '@app/modules/user/views/registration',

                ],
            ],
        ],
    ],


    'params' => $params,

    'modules' => [

       'frends'=>[
            'class'=>'app\modules\frends\Frends'
        ],
        'admin'=>[
            'class'=>'app\modules\admin\Admin'
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableGeneratingPassword'=>true,
            'modelMap' => [
                'Frends' => 'app\modules\user\models\Frends',
                'User' => 'app\modules\user\models\User',
                'Profile'=>'app\modules\user\models\Profile',
                'RegistrationForm'=>'app\modules\user\models\RegistrationForm',
            ],
            'controllerMap' => [
                'settings' => 'app\modules\user\controllers\SettingsController',
                'security' => 'app\modules\user\controllers\SecurityController',
                'frends' => 'app\modules\user\controllers\FrendsController',
            ],
/*
 *
 *
Пользователь robot@paruram.ru успешно создан!

Пароль: bIv0d.3BzHJn

Адрес для входа в Почту: https://biz.mail.ru/login/paruram.ru

Инструкция для пользователей


 */
            'mailer' => [
                'sender'                => 'happy@paruram.ru', // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Welcome subject',
                'confirmationSubject'   => 'Confirmation subject',
                'reconfirmationSubject' => 'Email change subject',
                'recoverySubject'       => 'Recovery subject',

            ],
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['marat'],

//            'registration_ip' =>'0.0.0.0',
        ],
    ],

];
//var_dump(YII_ENV_DEV);die;
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
