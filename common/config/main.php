<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/remesas.cl/frontend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],      
        
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/remesas.cl/backend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
