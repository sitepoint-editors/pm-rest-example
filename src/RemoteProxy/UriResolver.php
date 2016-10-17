<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.10.16
 * Time: 16:23
 */

namespace RemoteProxy;

use Doctrine\Common\Annotations\AnnotationReader;
use RemoteProxy\Annotation\Endpoint;
use Doctrine\Common\Annotations\AnnotationRegistry;
class UriResolver
{

    /**
     * Annotation reader instance
     * @var \Doctrine\Common\Annotations\AnnotationReader
     */
    protected $annotationReader;

    public function __construct()
    {
        $this->annotationReader = new AnnotationReader();
    }

    /**
     * @param $interface
     * @return array
     */
    public function getMappings($interface)
    {
        AnnotationRegistry::registerLoader('class_exists');

        $mappings = [];

        $methods = (new \ReflectionClass($interface))->getMethods();

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