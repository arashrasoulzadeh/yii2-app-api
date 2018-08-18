<?php
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

require __DIR__ . '/core/vendor/autoload.php';
require __DIR__ . '/core/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/core/common/config/bootstrap.php';
require __DIR__ . '/core/rest/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/core/common/config/main.php',
    require __DIR__ . '/core/common/config/main-local.php',
    require __DIR__ . '/core/rest/config/main.php',
    require __DIR__ . '/core/rest/config/main-local.php'
);

(new yii\web\Application($config))->run();
