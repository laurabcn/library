<?php

namespace Tests\Unit\Application\GetBooks;

use App\Application\GetBooks\GetBooks;
use App\Application\GetBooks\GetBooksRequest;
use App\Domain\Books\Book;
use App\Infrastructure\Books\BookInMemoryRepository;
use PHPUnit\Framework\TestCase;

class GetBooksTest extends TestCase
{
    /** @var GetBooks */
    private $sut;

    /** @var BookInMemoryRepository */
    private $repository;

    protected function setUp()
    {
        $this->repository = new BookInMemoryRepository();

        $this->addBooks();

        $this->sut = new GetBooks($this->repository);
    }

    public function testSuccess()
    {
        $getBooksRequest = new GetBooksRequest();

        $getBooksRequest->offset = 0;
        $getBooksRequest->count = 5;

        $response = $this->sut->execute($getBooksRequest);

        $this->assertEquals($response[0]->title(), 'El juego del Angel');
        $this->assertCount( 5, $response);
    }

    public function testSuccessWithBooks()
    {
        $getBooksRequest = new GetBooksRequest();

        $getBooksRequest->offset = 5;
        $getBooksRequest->count = 3;
        $response = $this->sut->execute($getBooksRequest);

        $this->assertEquals($response[0]->title(), 'Tengo tu numero');
        $this->assertCount( 3, $response);
    }


    private function addBooks()
    {
        $book = new Book(
            'Carlos Ruiz Zafon',
            'El juego del Angel',
            15.9,
            'https://ellectorespectador.files.wordpress.com/2012/03/juego-angel-zafon-detdn.jpg'
        );
        $this->repository->add($book);

        $book = new Book(
            'Isabel Allende',
            'La casa de los espiritus',
            10.9,
            'https://www.elsotano.com/cover/2890/0/1/358-450/casa-de-los-espiritus-la/9786073104562.jpg'
        );
        $this->repository->add($book);

        $book = new Book(
            'Eduardo Mendoza',
            'La ciudad de los prodigios',
            7.8,
            'https://imagessl4.casadellibro.com/a/l/t0/04/9788432217104.jpg'
        );
        $this->repository->add($book);

        $book = new Book(
            'Shakespeare',
            'King Lear',
            10.3,
            'https://imagessl0.casadellibro.com/a/l/t0/00/9788494653100.jpg'
        );
        $this->repository->add($book);

        $book = new Book(
            'Neal Stephenson',
            'Criptonomicon',
            20.9,
            'https://imagessl1.casadellibro.com/a/l/t0/81/9788466658881.jpg'
        );
        $this->repository->add($book);

        $book = new Book(
            'Sophie kinsella',
            'Tengo tu numero',
            6.5,
            'https://imagessl9.casadellibro.com/a/l/t0/79/9788490328279.jpg'
        );
        $this->repository->add($book);

        $book = new Book(
            'Noah Gordon',
            'El Rabino',
            12.9,
            'https://http2.mlstatic.com/el-rabino-noah-gordon-D_NQ_NP_997923-MLU26244256904_102017-F.webp'
        );
        $this->repository->add($book);

        $book = new Book(
            'Nacho Carretero',
            'Farinha',
            8.6,
            'https://imagessl0.casadellibro.com/a/l/t0/60/9788416001460.jpg'
        );
        $this->repository->add($book);

        $book = new Book(
            'Nelson Mandela',
            'Cartas desde la prisión',
            5.9,
            'https://imagessl2.casadellibro.com/a/l/t0/defecto2.jpg'
        );
        $this->repository->add($book);
        $book = new Book(
            'Benjamin Franklin',
            'Autobiografia',
            7.9,
            'https://imagessl7.casadellibro.com/a/l/t0/27/9788437629827.jpg'
        );

        $this->repository->add($book);

    }
}


