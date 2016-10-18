<?php

use Silex\Application;
use Api\Controller\BookControllerProvider;
use RemoteProxy\RestProxyFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

$app = new Application();

$app->mount('/api/v1', new BookControllerProvider());

$app->get('test-proxy', function (Application $app) {            
    
    $proxy = RestProxyFactory::create('\RemoteProxy\BookInterface', 'http://localhost:9000/api/v1');
    return new JsonResponse([
        'books' => $proxy->getBooks(),
    ]);
});

return $app;