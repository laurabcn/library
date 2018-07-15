<?php

namespace Tests\Unit\Application\AddBook;

use App\Application\AddBook\AddBook;
use App\Application\AddBook\AddBookRequest;
use App\Domain\Books\Book;
use App\Infrastructure\Books\BookInMemoryRepository;
use PHPUnit\Framework\TestCase;

class AddBookTest extends TestCase
{
    /** @var AddBook */
    private $sut;

    /** @var BookInMemoryRepository */
    private $repository;

    protected function setUp()
    {
        $this->repository = new BookInMemoryRepository();

        $book = new Book(
            'Zafon',
            'El juego del angel',
            12.6,
            'https://ellectorespectador.files.wordpress.com/2012/03/juego-angel-zafon-detdn.jpg'
        );

        $this->repository->add($book);

        $this->sut = new AddBook($this->repository);
    }

    public function testSuccess()
    {
        $request = new AddBookRequest();
        $request->title = 'El Rabino';
        $request->price = 12.9;
        $request->author = 'Noah Gordon';
        $request->image = 'https://http2.mlstatic.com/el-rabino-noah-gordon-D_NQ_NP_997923-MLU26244256904_102017-F.webp';

        $response = $this->sut->execute($request);

        $this->assertEquals($response->title(), $request->title);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Empty title
     */
    public function testInvalidThrowExceptionWithoutTitle()
    {
        $request = new AddBookRequest();
        $request->price = 12.9;
        $request->author = 'Noah Gordon';
        $request->image = 'https://http2.mlstatic.com/el-rabino-noah-gordon-D_NQ_NP_997923-MLU26244256904_102017-F.webp';

        $this->sut->execute($request);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Not valid price
     */
    public function testInvalidThrowExceptionWrongPrice()
    {
        $request = new AddBookRequest();
        $request->title = 'El Rabino';
        $request->price = 'error';
        $request->author = 'Noah Gordon';
        $request->image = 'https://http2.mlstatic.com/el-rabino-noah-gordon-D_NQ_NP_997923-MLU26244256904_102017-F.webp';

        $this->sut->execute($request);
    }
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Not valid image
     */
    public function testInvalidThrowExceptionWrongImage()
    {
        $request = new AddBookRequest();
        $request->title = 'El Rabino';
        $request->price = 12.9;
        $request->author = 'Noah Gordon';
        $request->image = 'error';

        $this->sut->execute($request);
    }
}

