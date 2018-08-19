<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-rest',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'en',
    'defaultRoute' => 'v1/user/profile',
    'controllerNamespace' => 'rest\controllers',
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
            'on beforeSend' => function ($event) {
//                header("Access-Control-Allow-Origin: *");
//                header("Access-Control-Allow-Method: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS");
//                header("Access-Control-Allow-Headers: content-type, authorization, access-control-allow-headers, access-control-allow-method, access-control-allow-credentials");
//                header("Access-Control-Allow-Credentials: true");

                $debugRoute = preg_match('%debug%', Yii::$app->getRequest()->getPathInfo());
                if (!YII_DEBUG or !$debugRoute) {
                    $response = $event->sender;
                    if ($response->data !== null) {
                        if (!$response->isSuccessful) {
                            if (isset($response->data['type'])) {
                                unset($response->data['type']);
                            }
                        }
                        if (isset($response->data['data'])) {
                            $response->data['success'] = $response->isSuccessful;
                        } else {
                            $response->data = [
                                'success' => $response->isSuccessful,
                                'data' => $response->data,
                            ];
                        }
                    }
                }
            },
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => null
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => require('url-rules.php')
        ],
    ],
    'params' => $params,
];
