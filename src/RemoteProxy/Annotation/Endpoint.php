<?php

namespace RemoteProxy\Annotation;

/**
 * @Annotation
 */
class Endpoint
{
    /**
     * The path
     *
     * @var string
     */
    public $path;
    
    /**
     * The method to access the endpoint
     *
     * @var string
     */
    public $method;

    /**
     * Instantiate the annotation
     */
    public function __construct($parameters)
    {
        $this->path   = $parameters['path'];
        $this->method = isset($parameters['method']) ? $parameters['method'] : 'get';
    }
}