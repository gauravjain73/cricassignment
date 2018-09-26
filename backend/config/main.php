<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [   
    'gridview' =>  [
        'class' => '\kartik\grid\Module'
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
    ],],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request'=>[
    'class' => 'common\components\Request',
    'web'=> '/backend/web',
    'adminUrl' => '/admin'
],
'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
              'cms-page' => 'cms-page/index',
              'cms-page/index' => 'cms-page/index',
              'cms-page/create' => 'cms-page/create',
              'cms-page/view/<id:\d+>' => 'cms-page/view',  
              'cms-page/update/<id:\d+>' => 'cms-page/update',  
              'cms-page/delete/<id:\d+>' => 'cms-page/delete',
              'cms-page/changestatus/<id:\d+>' => 'cms-page/changestatus',  
              'cms-page/<slug>' => 'cms-page/slug',
                    'defaultRoute' => '/site/index',
          ],   
],
'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => 'http://yii2test.com/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    
    'params' => $params,
];
