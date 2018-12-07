<?php
error_reporting(0);
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'assetManager' => [

            'bundles' => [

                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [(stristr($_SERVER['REQUEST_URI'], "/admin"))?'css/bootstrap.css':'style.css']
                ]
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Vaishy-Vivah-Bandhan',
            'baseUrl' => '/Vaishy-Vivah-Bandhan',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'image' => [
            'class' => 'yurkinx\yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],
        'user' => [
            'identityClass' => stristr($_SERVER['REQUEST_URI'], "/admin") ? 'app\modules\admin\models\Admin' : 'app\models\User',
            'enableAutoLogin' => true,
        ],        
        'session' => [
		    'name' => stristr($_SERVER['REQUEST_URI'], "/admin") ? 'VVBADM_SESSID' : 'PHPSESSID',
		],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'vaishyvivahbandhan.com',
				'username' => 'info@vaishyvivahbandhan.com',
				'password' => 'xTa&*q_pIDIx',
				'port' => '25',
			],
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
        'baseUrl' => '/Vaishy-Vivah-Bandhan',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
                'admin/logout'=> 'admin/default/logout',
                'admin/dashboard'=> 'admin/default/dashboard',
				'contact' => 'site/contact',
				'about' => 'site/about',
				'testimonial' => 'site/testimonial',
				'service' => 'site/service',
            ],
        ]
    ],
    'params' => $params,
    'layout' => (stristr($_SERVER['REQUEST_URI'], "/admin")) ? '@app/web/themes/backend/default/templates/Default/Page':'@app/web/themes/frontend/vivahBandhan/templates/Default/Page',
    'modules' => [

        'member' => [

            'class' => 'app\modules\member\Module',

        ],
        'admin' => [

            'class' => 'app\modules\admin\Module',

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
