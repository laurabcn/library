<?php

namespace Tests\Unit\Application\GetBook;

use App\Application\GetBook\GetBook;
use App\Application\GetBook\GetBookRequest;
use App\Domain\Books\Book;
use App\Domain\Identity;
use App\Infrastructure\Books\BookInMemoryRepository;
use PHPUnit\Framework\TestCase;

class GetBookTest extends TestCase
{
    /** @var GetBook */
    private $sut;

    /** @var BookInMemoryRepository */
    private $repository;

    /** @var Book */
    private $book;

    protected function setUp()
    {
        $this->repository = new BookInMemoryRepository();

        $this->book = new Book(
            'Noah Gordon',
            'El Rabino',
            12.9,
            'https://http2.mlstatic.com/el-rabino-noah-gordon-D_NQ_NP_997923-MLU26244256904_102017-F.webp'
        );
        $this->repository->add($this->book);

        $this->sut = new GetBook($this->repository);
    }

    public function testSuccess()
    {
        $request = new GetBookRequest();
        $request->identity = $this->book->identity();

        $response = $this->sut->execute($request);

        $this->assertEquals($response->title(), $this->book->title());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid required identity value
     */
    public function testInvalidThrowExceptionWrongIdentity()
    {
        $request = new GetBookRequest();
        $request->identity = 15;

        $this->sut->execute($request);

    }
}

