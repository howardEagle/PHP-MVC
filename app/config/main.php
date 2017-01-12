<?php

return [
    'name' => 'My cool blog',
    'controllerNamespace' => 'app\controllers',
    'basePath' => dirname(__DIR__),
    'db' => require(dirname(__FILE__) . '/db.php'),
    'errorAction' => 'index/error'
];