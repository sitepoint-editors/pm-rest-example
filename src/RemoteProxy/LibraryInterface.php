<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.10.16
 * Time: 15:59
 */

namespace RemoteProxy;

use RemoteProxy\Annotation\Endpoint;

interface LibraryInterface
{
    /**
     * Return Books
     * @Endpoint(path="/books")
     */
    public function getBooks();


    /**
     * Return books details
     * @Endpoint(path="/books/:id")
     *
     * @param $id
     * @return mixed
     */
     public function getBook($id);

    /**
     * Return authors of a book
     * @Endpoint(path="/books/:id/authors")
     * @param $id
     * @return mixed
     */
     public function getAuthors($id);
}