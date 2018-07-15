<?php

namespace App\Application\GetBooks;

use App\Domain\Books\BookCollection;
use App\Domain\Books\BookRepository;

class GetBooks
{
    /** @var BookRepository */
    private $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetBooksRequest $request): array
    {
        $this->sanitize($request);

        $bookCollection = $this->repository->find($request->offset, $request->count);

        return $bookCollection;
    }

    private function sanitize(GetBooksRequest $request)
    {

        if (!is_int($request->offset)) {
           $request->offset = 10;
        }

        if ( !is_int($request->count)) {
            $request->count = 0;
        }
    }
}