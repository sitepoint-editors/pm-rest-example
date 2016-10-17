<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.10.16
 * Time: 16:47
 */

namespace RemoteProxy;

use Doctrine\Common\Annotations\AnnotationRegistry;
use RemoteProxy\Adapter\RestAdapter;
use ProxyManager\Factory\RemoteObjectFactory;
use GuzzleHttp\Client;

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
        $uriResolver = (new UriResolver())->getMappings($interface);

        $factory = new \ProxyManager\Factory\RemoteObjectFactory(
            new RestAdapter(
                new \GuzzleHttp\Client([
                    'base_uri' => rtrim($base_uri, '/') . '/',
                ]),
                $uriResolver
            )
        );
        return $factory->createProxy($interface);
    }
}
