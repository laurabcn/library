<?php

namespace App\Application\AddBook;

use App\Domain\Books\Book;
use App\Domain\Books\BookRepository;

class AddBook
{
    /** @var BookRepository */
    private $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(AddBookRequest $request): Book
    {
        $this->validate($request);

        $book = new Book($request->author, $request->title, $request->price, $request->image);

        $this->repository->add($book);

        return $book;
    }

    private function validate(AddBookRequest $request)
    {
        if (empty($request->author)) {
            throw new \InvalidArgumentException('Invalid required author');
        }

        if (empty($request->title)) {
            throw new \InvalidArgumentException("Empty title");
        }

        if (empty($request->price) || !is_float($request->price)) {
            throw new \InvalidArgumentException("Not valid price");
        }

        if (empty($request->image) || !filter_var($request->image, FILTER_VALIDATE_URL)  ) {
            throw new \InvalidArgumentException("AddBooks: Not valid image");
        }
    }
}