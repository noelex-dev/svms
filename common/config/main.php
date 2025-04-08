<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
    ],
    'modules' => [
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
        'cms' => [
            'class' => 'frontend\views\cms\Module',
        ],
        'record' => [
            'class' => 'frontend\views\record\Module',
        ],
        'generate' => [
            'class' => 'frontend\views\generate\Module',
        ],
    ],
    'timeZone' => 'Asia/Manila',
];
