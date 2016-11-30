<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'stroiyt.ru',

    'name'=>'Строительная компания ‘StroiYt’',
    'language' => 'ru-RU',
    //'sourceLanguage' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    'modules' => [
       'cms' => [
            'class' => 'app\modules\cms\cms',
            'layout'=>'main',
           'components' =>[
               'errorHandler' => [
                   'class'=>'yii\base\ErrorHandeler',
               ],
           ],
        ],
    ],

    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
            'disabledCommands' => ['netmount'], //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands

            'roots' => [
                [
                    'baseUrl'=>'@web',
                    'basePath'=>'@webroot',
                    'path' => 'uploads',
                    'name' => 'Глобальные',
                  //  'access' => ['read' => '@', 'write' => '@'],
                ],
               [
                    'class' => 'mihaildev\elfinder\volume\UserPath',
                    'path'  => 'uploads/user/user_{id}',
                    'name'  => 'Мои Документы',


                ],
            ],
           /* 'watermark' => [

                'source'         => 'uploads/logo.png', // Path to Water mark image//__DIR__.
                'marginRight'    => 5,          // Margin right pixel
                'marginBottom'   => 5,          // Margin bottom pixel
                'quality'        => 75,         // JPEG image save quality
                'transparency'   => 70,         // Water mark image transparency ( other than PNG )
                'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
                'targetMinPixel' => 200         // Target image minimum pixel size
            ],*/

        ]
    ],

    'components' => [
        'layout'=>'main',
        'view' => [
            'class' => 'yii\web\View',
            //'layout'=>'main',
            'theme' => [
               // 'basePath' => '@app/theme/basic',
             //   'baseUrl' => '@web/theme/basic',
                'baseUrl'=>"/theme/classic",
                'pathMap' => [
                    '@app/views' => '@app/theme/classic',
                    '@app/modules' => '@app/theme/classic/modules',
                ],
            ],
        ],

        'formatter' => [
            'timeZone' => 'Europe/Moscow',
            'dateFormat' => 'd.MM.Y',
            'timeFormat' => 'H:mm:ss',
            //'datetimeFormat' => 'd.MM.Y HH:mm',
            'datetimeFormat' => 'php:Y-m-d H:i:s',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
           // 'class'=>'yii\web\UrlManager',

            'showScriptName' => false,
            'enableStrictParsing' => false,
            'suffix'=>'/',
            'rules' =>
                [
                    '/'=>'site/index',
                    '/login'=>'cms/default/login',
                    '/logout'=>'cms/default/logout',
                    'cms'=>'cms/default/index',
                    'cms/user'=>'cms/user/index',
                    'cms/services'=>'cms/services/index',
                    'cms/<action>'=>'cms/default/<action>',
                //    '<_m:debug>/<_c:\w+>/<_a:\w+>' => '<_m>/<_c>/<_a>',
                    '<action>' => 'site/<action>',

                    '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
                    '<controller:(post|comment)>/<id:\d+>' => '<controller>/view',
                    '<controller:(post|comment)>s' => '<controller>/index',
                ]
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'weC5RcfYWZmKzxXroJJb5TRySMG1iP81',
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => [
                'user',
                'moderator',
                'admin',
            ],
        ],

        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['cms/default/login'],

        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','trace','info'],//,'trace','info'
                ],
            ],
        ],

        'db' => require(__DIR__ . '/db.php'),

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app'       => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],

    'params' => $params,

];
           


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1',  '95.220.73.123'] ,//'*',
      //  'enableDebugLogs'=>true,
        'panels' => [
            'views' => ['class' => 'app\panels\ViewsPanel'],
        ],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1',  '95.220.73.123'] ,//'*',

    ];
}

return $config;
