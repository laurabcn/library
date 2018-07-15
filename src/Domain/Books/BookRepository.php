<?php

namespace App\Domain\Books;

use App\Domain\Identity;

interface BookRepository
{
    public function add(Book $book);
    public function find(int $offset, int $count);
    public function findByIdentity(Identity $identity);
}
