<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'noty' => [
            'class' => 'lo\modules\noty\Module',
        ],
        'actionlog' => [
            'class' => 'common\modules\logger\Module',
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'keyPrefix' => 'amelok_cache',
            'cachePath' => '@common/cache'
        ],
        'urlManager' => [
            'class'             => yii\web\UrlManager::className(),
            'enablePrettyUrl'   => true,
            'showScriptName'    => false,
        ],
        'i18n' => [
            'class'      => uran1980\yii\modules\i18n\components\I18N::className(),
//            'languages'  => ['en', 'ru'],
            'languages'  => function() {
                return \common\models\Languages::find()->where(['status' => 1])->select('code')->column();
            },
            'format'     => 'db',
            'sourcePath' => [
                __DIR__ . '/../../frontend',
                __DIR__ . '/../../backend',
                __DIR__ . '/../../common',
            ],
            'messagePath' => __DIR__  . '/../../messages',
            'translations' => [
                '*' => [
                    'cache' => 'cache',
                    'class'           => yii\i18n\DbMessageSource::className(),
                    'enableCaching'   => true,
                    'cachingDuration' => 60 * 60 * 2,
                    //'forceTranslation' => true,
                ],
            ],
        ],
    ],
];
