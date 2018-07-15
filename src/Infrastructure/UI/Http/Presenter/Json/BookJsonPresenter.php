<?php

namespace App\Infrastructure\UI\Http\Presenter\Json;

use App\Domain\Books\Book;

class BookJsonPresenter
{
    public static function present(Book $book)
    {
        $response = [
            'id' => $book->identity(),
            'image' => $book->image(),
            'title' => $book->title(),
            'author' => $book->author(),
            'price' => $book->price()
        ];
        return $response;
    }
}