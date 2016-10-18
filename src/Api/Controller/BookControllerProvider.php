<?php

namespace Api\Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class BookControllerProvider implements ControllerProviderInterface
{
    /**
     * Save available ApiControllerActions in a ApiControllerFactory
     *
     * @param Application $app
     * @return mixed
     */
    public function connect(Application $app)
    {
        $controllerFactory = $app['controllers_factory'];

        /**
         * Return a books details
         */
        $controllerFactory->get('books/{id}', function (Application $app, $id)
        {
            return new JsonResponse([
                'details'=>'Details of books with id:'. $id
            ]);
        });


        /**
         * Return a list of books
         */

        $controllerFactory->get('books', function (Application $app)
        {
            return new JsonResponse([
                'books'=>'List of Books'
            ]);
        });

        $controllerFactory->get('books/{id}/authors', function (Application $app, $id)
        {
            return new JsonResponse([
                'authors'=>'Authors of book with id:' . $id,
            ]);
        });

        return $controllerFactory;
    }
}