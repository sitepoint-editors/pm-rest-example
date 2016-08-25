<?php

namespace RemoteProxy\Adapter;

use GuzzleHttp\ClientInterface;
use ProxyManager\Factory\RemoteObject\AdapterInterface;

class RestAdapter implements AdapterInterface
{    
    /**
     * Adapter client
     *
     * @var GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * Mapping information
     *
     * @var array
     */
    protected $map;

    /**
     * Constructor
     *
     * @param Client $client
     * @param array  $map    map of service names to their aliases
     */
    public function __construct(ClientInterface $client, $map = [])
    {
        $this->client  = $client;
        $this->map     = $map;
    }

    /**
     * {@inheritDoc}
     */
    public function call($wrappedClass, $method, array $parameters = [])
    {       
        if(!isset($this->map[$method])) {
            throw new \RuntimeException('No endpoint has been mapped to this method.');
        }

        $endpoint =  $this->map[$method];
        $path     = $this->compilePath($endpoint['path'], $parameters);

        $response = $this->client->request($endpoint['method'], $path);

        return (string) $response->getBody();  
    }

    /**
     * Get the service name will be used by the adapter
     *
     * @param string $wrappedClass
     * @param string $method
     *
     * @return string Service name
     */
    protected function compilePath($path, $parameters)
    {
        return preg_replace_callback('|:\w+|', function ($matches) use (&$parameters) {
            return array_shift($parameters);
        }, $path);
    }
}