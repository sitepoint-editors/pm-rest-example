<?php
use Silex\Application;
use Api\Controller\BookControllerProvider;
use RemoteProxy\RestProxyFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

$app = new Application();

$app->get('test-proxy', function (Application $app) {

    $proxy = RestProxyFactory::create('\RemoteProxy\LibraryInterface', 'http://localhost:9001/');

    /** @var  \RemoteProxy\LibraryInterface */
    $books =  $proxy->getBooks();

    return new JsonResponse([
        'books' => $books,
    ]);
});

return $app;