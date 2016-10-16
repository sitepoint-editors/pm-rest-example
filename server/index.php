<?php

require_once("../vendor/autoload.php");

$app = require __DIR__ . '/../src/server.php';

$app['debug'] = true;

$app->run();