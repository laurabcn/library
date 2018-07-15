<?php

namespace App\Infrastructure\UI\Http\Presenter\Json;

class BooksJsonPresenter
{
    public static function present(array $bookCollection)
    {
        $response = [];

        foreach ($bookCollection as $book){
            $response[] = [
                'id' => $book->identity(),
                'link' => $book->image(),
                'title' => $book->title()
            ];
        }

        return $response;
    }
}