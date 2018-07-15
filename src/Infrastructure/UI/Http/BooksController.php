<?php

namespace App\Infrastructure\UI\Http;

use App\Application\AddBook\AddBook;
use App\Application\AddBook\AddBookRequest;
use App\Application\GetBook\GetBook;
use App\Application\GetBooks\GetBooks;
use App\Application\GetBook\GetBookRequest;
use App\Application\GetBooks\GetBooksRequest;
use App\Infrastructure\UI\Http\Presenter\Json\AddBookJsonPresenter;
use App\Infrastructure\UI\Http\Presenter\Json\BookJsonPresenter;
use App\Infrastructure\UI\Http\Presenter\Json\BooksJsonPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BooksController extends Controller
{
    /** @var GetBooks  */
    private $books;
    /** @var GetBook  */
    private $book;
    /** @var AddBook  */
    private $newBook;

    public function __construct(GetBooks $books, GetBook $book, AddBook $newBook)
    {
        $this->books = $books;
        $this->book = $book;
        $this->newBook = $newBook;
    }
    
    public function listAction(Request $request)
    {
        $requestBooks = new GetBooksRequest();
        $requestBooks->offset = $request->get('offset');
        $requestBooks->count =$request->get('count');

        $booksResponse = $this->books->execute($requestBooks);

        return new JsonResponse(BooksJsonPresenter::present($booksResponse));
    }

    public function detailAction(Request $request)
    {
        $requestBook = new GetBookRequest();
        $requestBook->identity = $request->get('identity');

        $book = $this->book->execute($requestBook);

        return new JsonResponse(BookJsonPresenter::present($book));
    }

    public function newAction(Request $request)
    {
        $book = new AddBookRequest();

        $book->author = $request->get('author');
        $book->title  = $request->get('title');
        $book->price  = $request->get('price');
        $book->image  = $request->get('image');

        $book = $this->newBook->execute($book);

        return new JsonResponse(AddBookJsonPresenter::presenter($book));
    }
}