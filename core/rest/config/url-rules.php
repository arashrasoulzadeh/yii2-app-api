<?php
return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'v1/user',
        'extraPatterns' => [
            'OPTIONS login' => 'login',
            'POST login' => 'login',
        ]
    ],

    'debug/default/<action>' => 'debug/default/<action>'
];