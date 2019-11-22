<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'logreader'],
    'language' => 'ru',
    'timeZone' => 'Asia/Bangkok',
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
//            'admin/*',
//            'gii/*'
        ],
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@backend/views/layouts'
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin'
        ],
        'authenticator' => [
            'class' => 'x1ankun\Authenticator\GoogleAuthenticator'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-backend',
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
        'settings' => [
            'class' => 'backend\modules\settings\components\Settings'
        ],
        'mailer' => [
            'class'     => 'yii\swiftmailer\Mailer',
            'viewPath'  => '@app/mail',
            'transport' => [
                'class'         => 'Swift_SmtpTransport',
                'host'          => 'smtp.gmail.com',
                'username'      => 'info@amelok.com',
                'password'      => "613bq3raaA",
                'port'          => '587',
                'encryption'    => 'tls',
            ],
            'useFileTransport' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => '/site/login',
                'auth' => '/site/auth',
            ],
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets',
            'baseUrl' => '/backend/web/assets',
        ],
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'right-menu',
            'mainLayout' => '@app/views/layouts/main.php',
            // 'mainLayout' => '@vendor/mdmsoft/yii2-admin/views/layouts/main.php',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'idField' => 'id',
                    'usernameField' => 'email',
                    'extraColumns' => [
                        [
                            'header' => 'Full Name',
                            'value' => function($model, $key, $index, $column) {
                                return $model->first_name . ' ' . $model->last_name;
                            },
                        ],
                    ],
                    'searchClass' => 'backend\models\UsersSearch'
                ],
            ],
        ],
        'pages' => [
            'class' => 'backend\modules\pages\Module',
            'imperaviLanguage' => 'ru',
            'controllerMap' => [
                'manager' => [
                    'class' => 'backend\modules\pages\controllers\ManagerController'
                ],
            ],
            'pathToImages' => '@webroot/storage/static',
            'urlToImages' => '/backend/web/storage/static',
            'pathToFiles' => '@webroot/storage/static/files',
            'urlToFiles' => '/backend/web/storage/static/files',
            'uploadImage' => true,
            'uploadFile' => true,
            'addImage' => true,
            'addFile' => true,
        ],
        'i18n' => [
            'class' => uran1980\yii\modules\i18n\Module::className(),
            'controllerMap' => [
                'default' => uran1980\yii\modules\i18n\controllers\DefaultController::className(),
            ],
        ],
        'logreader' => [
            'class' => 'backend\modules\logs\Module',
            'aliases' => [
                'Frontend Errors' => '@frontend/runtime/logs/app.log',
                'Backend Errors' => '@backend/runtime/logs/app.log',
                'Console Errors' => '@console/runtime/logs/app.log',
            ],
        ],
        'settings' => [
            'class' => 'backend\modules\settings\Module',
            'sourceLanguage' => 'en'
        ],
    ],
    'params' => $params,
];
