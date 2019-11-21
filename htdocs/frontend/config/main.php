<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl'   => ''
        ],
        'user' => [
            'identityClass'     => 'common\models\User',
            'enableAutoLogin'   => true,
            'identityCookie'    => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class'     => 'yii\log\FileTarget',
                    'levels'    => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl'               => true,
            'showScriptName'                => false,
            'class'                         => 'frontend\components\UrlManager',
            'enableDefaultLanguageUrlCode'  => false,
            'rules' => [
                '' => '/site/index',
            ],
        ],
        'assetManager' => [
            'basePath'  => '@webroot/assets',
            'baseUrl'   => '/frontend/web/assets',
        ],
    ],
    'params' => $params,
];
