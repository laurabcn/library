<?php

namespace App\Infrastructure\Books;

use App\Domain\Books\BookCollection;
use App\Domain\Books\BookRepository;
use App\Domain\Books\Book;
use App\Domain\Identity;

class BookInMemoryRepository implements BookRepository
{
    /** @var BookCollection  */
    protected $bookCollection;

    public function __construct()
    {
        $this->bookCollection = new BookCollection();
    }

    public function find(int $offset, int $count)
    {
        return $this->bookCollection->slice($offset, $count);
    }

    public function findByIdentity(Identity $identity)
    {
        foreach ($this->bookCollection as $book) {
            if ($book->identity()->equals($identity)) {
                return $book;
            }
        }

        return [];
    }

    public function add(Book $book)
    {
        $this->bookCollection->add($book);
    }
}