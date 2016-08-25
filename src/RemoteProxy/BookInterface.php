<?php

namespace RemoteProxy;

use RemoteProxy\Annotation\Endpoint;

interface BookInterface {
    
    /**
     * Return all books
     *
     * @Endpoint(path="books")
     */
    public function getBooks();

    /**
     * Return book's details
     *
     *
     * @Endpoint(path="books/:id")
     * @param  int $id
     * @return mixed
     */
    public function getBook($id);

    /**
     * Return author of a book
     *
     * @Endpoint(path="books/:id/authors")
     * @param  int $id
     * @return mixed
     */
    public function getAuthors($id);
}