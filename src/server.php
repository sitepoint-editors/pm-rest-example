<?php
use Silex\Application;
use Api\Controller\BookControllerProvider;
use RemoteProxy\RestProxyFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

$app = new Application();
$app->mount('/', new BookControllerProvider());

return $app;