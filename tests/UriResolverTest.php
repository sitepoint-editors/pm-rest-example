<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.10.16
 * Time: 20:51
 */

use PHPUnit\Framework\TestCase;
use RemoteProxy\UriResolver;

class UriResoverTest extends TestCase
{
    /**
     * @var \RemoteProxy\Annotation\Endpoint
     */
    protected $uriResolver;

    /**
     *
     */
    public function setUp()
    {
        $this->uriResolver =  new UriResolver();
    }

    public function getUriResolver()
    {
        if ($this->uriResolver) return $this->uriResolver;

        return new UriResolver();
    }

    /**
     * test for a correct object
     */
    public function testInstance()
    {
        $this->assertInstanceOf('RemoteProxy\UriResolver', $this->getUriResolver());
    }

    /**
     * test if the books uri map is correct
     */
    public function testMappingBooks()
    {
        $mappings = $this->getUriResolver()->getMappings('RemoteProxy\LibraryInterface');

        $this->assertEquals($mappings['getBooks'], ['path' => '/books', 'method' =>'get']);
    }

    /**
     * test if the book by id uri map is correct
     */
    public function testMappingBook()
    {
        $mappings = $this->getUriResolver()->getMappings('RemoteProxy\LibraryInterface');

        $this->assertEquals($mappings['getBook'], ['path' => '/books/:id', 'method' =>'get']);
    }

    /**
     * test if the authors by id uri map is correct
     */
    public function testMappingAuthors()
    {
        $mappings = $this->getUriResolver()->getMappings('RemoteProxy\LibraryInterface');

        $this->assertEquals($mappings['getAuthors'], ['path' => '/books/:id/authors', 'method' =>'get']);
    }

    public function tearDown()
    {

    }
}