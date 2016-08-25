<?php

namespace RemoteProxy;    

use Doctrine\Common\Annotations\AnnotationReader;
use RemoteProxy\Annotation\Endpoint;

class UriResolver
{    
    /**
     * Annotation reader instance
     *
     * @var Doctrine\Common\Annotation\AnnotationReader
     */
    protected $annotationReader;

    /**
     * Instantiate the URI resolver
     *
     */
    public function __construct()
    {
        $this->annotationReader = new AnnotationReader();
    }

    /**
     * Return an array of mapping information
     *
     * @param string $interface
     *
     * @return array
     */
    public function getMappings($interface) {

        $mappings   = [];
        $methods    = (new \ReflectionClass($interface))->getMethods(); 

        foreach ($methods as $method) {
            $annotations = $this->annotationReader->getMethodAnnotations($method);
            foreach($annotations as $annotation) {
                if ($annotation instanceof Endpoint) {
                    $mappings[$method->name] = ['path' => $annotation->path, 'method' => $annotation->method];
                }
            }

        }

        return $mappings;
    }

}