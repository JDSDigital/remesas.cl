<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
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
    ],
];
