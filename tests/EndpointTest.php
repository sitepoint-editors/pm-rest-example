<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.10.16
 * Time: 20:51
 */

use PHPUnit\Framework\TestCase;
use RemoteProxy\Annotation\Endpoint;

class EndpointTest extends TestCase
{
    /**
     * @var \RemoteProxy\Annotation\Endpoint
     */
    protected $endpoint;

    /**
     * @var \RemoteProxy\Annotation\Endpoint
     */
    protected $endpointWithDefaultMethod;

    /**
     * Save different kind of possible endpoints.
     * One with given method and one with default method
     */
    public function setUp()
    {
        $this->endpoint =  new Endpoint(array('path'=>'/books','get'));

        $this->endpointWithDefaultMethod =  new Endpoint(array('path'=>'/books'));
    }

    /**
     * Test if the object is from the correct type
     */
    public function testEndpointsInstance()
    {
        $this->assertInstanceOf('RemoteProxy\Annotation\Endpoint', $this->endpoint);
    }

    /**
     * Test the property path on the endpoint
     */
    public function testEndpointPath()
    {
        $this->assertEquals($this->endpoint->path, '/books');
    }

    /**
     * Test the property method on the endpoint
     */
    public function testEndpointMethod()
    {
        $this->assertEquals($this->endpoint->method, 'get');
    }

    /**
     * Test the a missing method on the endpoint
     */
    public function testEndpointMethodDefault()
    {
        $this->assertEquals($this->endpointWithDefaultMethod->method, 'get');
    }

    public function tearDown()
    {

    }
}