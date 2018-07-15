<?php

namespace App\Infrastructure\UI\Http\Presenter\Json;

use App\Domain\Books\Book;

class AddBookJsonPresenter
{
    public static function presenter(Book $book)
    {
        $response = [
            'id' => $book->identity()->getValue(),
            'image' => $book->image(),
            'title' => $book->title(),
            'author' => $book->author(),
            'price' => $book->price()
        ];
        return ($response);
    }
}