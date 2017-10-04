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
            'baseUrl' => '/remesas.cl/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],      
        
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/remesas.cl/admin',
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
                'username' => 'testcore@geknology.com',
                'password' => 'M@chupichu2012',
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
        ]
    ],
];
