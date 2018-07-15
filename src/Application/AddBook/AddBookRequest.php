<?php

namespace App\Application\AddBook;

class AddBookRequest
{
    /** @var string */
    public $author;

    /** @var string */
    public $title;

    /** @var float */
    public $price;

    /** @var string */
    public $image;
}
