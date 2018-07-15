<?php

namespace App\Application\GetBook;

use App\Domain\Books\Book;
use App\Domain\Books\BookRepository;
use Ramsey\Uuid\Uuid;

class GetBook
{
    /** @var BookRepository */
    private $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetBookRequest $request): Book
    {
        $this->validate($request);

        $book = $this->repository->findByIdentity($request->identity);

        return $book;
    }

    private function validate(GetBookRequest $request)
    {
        if (!Uuid::isValid( $request->identity)) {
            throw new \InvalidArgumentException('Invalid required identity value');
        }
    }
}