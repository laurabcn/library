<?php

namespace App\Domain\Books;

use App\Domain\Identity;

class Book
{
    /** @var Identity */
    protected $identity;

    /** @var string */
    protected $author;

    /** @var string */
    protected $title;

    /** @var float */
    protected $price;

    /** @var string */
    protected $image;

    public function __construct($author, $title, $price, $image)
    {
        $this->identity = new Identity();
        $this->author = $author;
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
    }

    public function identity() : Identity
    {
        return $this->identity;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function title() : string
    {
        return $this->title;
    }

    public function price() : float
    {
        return $this->price;
    }

    public function image() : string
    {
        return $this->image;
    }
}
