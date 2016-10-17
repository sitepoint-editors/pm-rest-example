<?php

require_once("../vendor/autoload.php");

$app = require __DIR__ . '/../src/client.php';

$app['debug'] = true;

$app->run();