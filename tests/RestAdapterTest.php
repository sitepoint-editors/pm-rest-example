<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.10.16
 * Time: 20:51
 */

use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;

class RestAdapterTest extends TestCase
{

    protected $client;

    public function setUp()
    {
        $this->client = new Client(['base_uri'=>'http://fakeurl']);
    }

    public function testInstance()
    {
        $this->assertInstanceOf('GuzzleHttp\Client', $this->client);
    }

    public function tearDown()
    {

    }
}