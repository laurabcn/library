<?php

namespace App\Application\GetBooks;

use App\Domain\Books\BookCollection;

interface GetBooksPresenter
{
    public function convert(BookCollection $bookCollection): array;
}