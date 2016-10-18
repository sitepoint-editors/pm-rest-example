<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.10.16
 * Time: 20:51
 */

use PHPUnit\Framework\TestCase;
use RemoteProxy\RestProxyFactory;

class RestProxyFactoryTest extends TestCase
{
    /**
     * @var \RemoteProxy\Annotation\Endpoint
     */
    protected $factory;


    /**
     * Save different kind of possible endpoints.
     * One with given method and one with default method
     */
    public function setUp()
    {
        $this->factory =  new RestProxyFactory('\RemoteProxy\LibraryInterface', 'htpp:/amockurl');
    }

    public function getFactory()
    {
        return new RestProxyFactory('\RemoteProxy\LibraryInterface', 'htpp:/amockurl');
    }

    /**
     * test for a correct object
     */
    public function testInstance()
    {
        $this->assertInstanceOf('RemoteProxy\RestProxyFactory', $this->factory);
    }


    /**
     * test for a correct object
     */
    public function testCreate()
    {
        $proxy = $this->getFactory()->create('\RemoteProxy\LibraryInterface', 'http://fakeurl');

        $this->assertInstanceOf('\ProxyManager\Proxy\RemoteObjectInterface', $proxy);
    }

    public function tearDown()
    {

    }
}