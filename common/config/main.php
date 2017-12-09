<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'es',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],      
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/admin',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'formatter' => [
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'USD',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false, //for the testing purpose, you need to enable this

            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.geknology.com',
                'username' => 'noresponder@remesas.cl',
                'password' => 'Remesas2017',
                'port' => '587',
                'encryption' => 'tls',
                'streamOptions' => [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
            // web error handler
            // 'class' => '\bedezign\yii2\audit\components\web\ErrorHandler',
            // console error handler
            //'class' => '\bedezign\yii2\audit\components\console\ErrorHandler',
        ],
        /*'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
                    'categories' => ['yii\db\*'],
                    'message' => [
                        'from' => ['log@example.com'],
                        'to' => ['admin@example.com', 'developer@example.com'],
                        'subject' => 'Database errors at example.com',
                    ],
                ],
            ],
        ],*/
    ],
];
