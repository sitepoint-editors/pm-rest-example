<?php

namespace RemoteProxy;

use Doctrine\Common\Annotations\AnnotationRegistry;
use RemoteProxy\Adapter\RestAdapter;

class RestProxyFactory
{
    /**
     * Create a Restful remote object proxy
     *
     * @param  string $interface
     * @param  string $base_uri
     *
     * @return \ProxyManager\Proxy\RemoteObjectInterface
     */
    public static function create($interface, $base_uri)
    {             
        AnnotationRegistry::registerLoader('class_exists');

        $factory = new \ProxyManager\Factory\RemoteObjectFactory(
            new RestAdapter(
                new \GuzzleHttp\Client([
                    'base_uri' => rtrim($base_uri, '/') . '/',
                ]),
                (new UriResolver())->getMappings($interface)
            )
        );

       return $factory->createProxy($interface);
    }
}