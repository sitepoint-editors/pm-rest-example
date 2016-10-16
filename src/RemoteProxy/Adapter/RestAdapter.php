<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.10.16
 * Time: 15:26
 */

namespace RemoteProxy\Adapter;

use ProxyManager\Factory\RemoteObject\AdapterInterface;
use GuzzleHttp\ClientInterface;

class RestAdapter implements AdapterInterface
{
    /**
     * Adapter client
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;
    /**
     * Mapping information
     *
     * @var array
     */
    protected $map;

    /**
     * RestAdapter constructor.
     * @param ClientInterface $client
     * @param array $map
     */
    public function __construct(ClientInterface $client, $map = [])
    {
        $this->client  = $client;
        $this->map     = $map;
    }
    /**
     * {@inheritDoc}
     */
    public function call(string $wrappedClass, string $method, array $parameters = [])
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
     * @param $path
     * @param $parameters
     * @return mixed
     */
    protected function compilePath($path, $parameters)
    {
        return preg_replace_callback('|:\w+|', function ($matches) use (&$parameters) {
            return array_shift($parameters);
        }, $path);
    }
}