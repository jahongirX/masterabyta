<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'timeZone' => 'Europe/Moscow',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'uObIk2NdG99MKZS7Hb573jsDEk1siclCm8stFY',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['user', 'manager', 'admin'],
        ],
        'user' => [
            'loginUrl' => array('site/index'), // Страница для неавторизованных пользователей
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'project@etalon-web.ru',
                'password' => 'jcojzxowdnjhlujr',
                'port' => '465',
                'encryption' => 'ssl',
            ],
            'messageConfig' => [
                'from' => ['project@etalon-web.ru' => 'Городская диспетчерская'],
            ],

            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                // отключаем логирование
                // [
                //     'class' => 'yii\log\FileTarget',
                //     'levels' => ['error', 'warning'],
                // ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            
            // Добавляем слеш вконце URL
            'suffix' => '/',
            'normalizer' => [
              'class' => 'yii\web\UrlNormalizer',
              'normalizeTrailingSlash' => true,
              'collapseSlashes' => true,
           ],

            'rules' => [
                '<module:admin>' => '<module>/default',
                '<module:admin>/<controller:[\w-]+>/<action:[\w-]+>' => '<module>/<controller>/<action>',
                '<module:admin>/<controller:[\w-]+>' => '<module>/<controller>',
                '/' => 'site/index',

                // '/parser/<action>' => 'parser/<action>',

                // '/sitemap.xml' => 'site/sitemap',
                // '/robots.txt' => 'site/robots',

                [
                    'pattern' => '/sitemap.xml',
                    'route' => 'site/sitemap',
                    'suffix' => '',
                ],
                [
                    'pattern' => '/robots.txt',
                    'route' => 'site/robots',
                    'suffix' => '',
                ],

                'elfinder/<action:[\w-]+>' => 'elfinder/<action>',
                '<action:login|c9e2b723478d81d18|send|send-validate|send-confirm|logout|search|get-city-list>' => 'site/<action>',
                '<action:amocrm-redirect|amocrm-hook|test>' => 'site/<action>',
                
                // '<action:[\w-\/]+>' => 'site/index',

                '<category1:[\w-]+>/<category2:[\w-]+>/<category3:[\w-]+>/<action:[\w-]+>' => 'site/index',
                '<category1:[\w-]+>/<category2:[\w-]+>/<action:[\w-]+>' => 'site/index',
                '<category1:[\w-]+>/<action:[\w-]+>' => 'site/index',
                '<action:[\w-]+>' => 'site/index',
            ],
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['ElfinderFull'],
            'root' => [
                'path' => 'upload/elfinder',
                'name' => 'Elfinder'
            ]
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1','localhost'],
    ];
}

return $config;
