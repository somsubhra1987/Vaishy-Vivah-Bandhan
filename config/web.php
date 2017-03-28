<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'assetManager' => [

            'bundles' => [

                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ]
                
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Vaishy-Vivah-Bandhan',
            'baseUrl' => '/devzone/Vaishy-Vivah-Bandhan',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'image' => [
            'class' => 'yurkinx\yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
        'baseUrl' => '/devzone/Vaishy-Vivah-Bandhan',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [

            ],
        ]
    ],
    'params' => $params,
    'layout' => '@app/web/themes/frontend/vivahBandhan/templates/Default/Page',
    'modules' => [

        'member' => [

            'class' => 'app\modules\member\Module',

        ],

    ],

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;