<?php
return [
    'controllerNamespace' => 'backend\controllers',
    'basePath' => dirname(__DIR__),
    'db' => require(dirname(__FILE__) . '/db.php'),
    'errorAction' => 'main/error',
    'defaultController' => 'main'
];

