<?php

namespace App\Infrastructure\Books;

use App\Domain\Books\Book;

class BookPersistable extends Book
{
    static public function toArray(Book $book){

        return [
            'identity' => hexdec($book->identity()),
            'author'   => $book->author(),
            'title'    => $book->title(),
            'image'    => $book->image(),
            'price'    => $book->price()
        ];
    }
}