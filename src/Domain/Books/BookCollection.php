<?php

namespace App\Domain\Books;


class BookCollection implements \Countable, \IteratorAggregate
{
    /** @var Book[] */
    private $books = [];

    public function add(Book $book): self
    {
        $this->books[] = $book;

        return $this;
    }

    public function books(): array
    {
        return $this->books;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->books);
    }

    public function count()
    {
        return count($this->books);
    }

    public function slice(int $offset, int $count)
    {
        return array_slice($this->books, $offset, $count);
    }
}