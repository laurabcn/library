<?php

namespace Tests\Integration\Infrastructure\UI\Http;

use App\Domain\Identity;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BooksControllerTest extends WebTestCase
{
    /** @var Identity */
    private $identityBook;

    public function testBooks()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/books');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAddBook()
    {
        $client = static::createClient();

        $client->request('POST', '/api/v1/books', [
            'author'=> 'Neal Stephenson',
            'title' => 'Cryptonomicon',
            'price' => 12.9,
            'image'   => 'https://imagessl1.casadellibro.com/a/l/t0/81/9788466658881.jpg'
        ]);

        $book = json_decode($client->getResponse()->getContent(), true);

        $this->identityBook = $book['id'];

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testBook()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/books', ['identity' => $this->identityBook]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}