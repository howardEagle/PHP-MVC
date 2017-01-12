<?php
require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../app/models/dao/autoload.php');
require(__DIR__ . '/../../core/Pie.php');
$config = require('../config/main.php');
$application = new Pie($config);
$application->run();