<?php

namespace App\Tests\Fonctionnel\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
    public function testBook(): void 
    //à garder en minuscule
    {
        $client = static::createClient();
        $client->request('GET', '/books');

        self::assertResponseIsSuccessful();
    }

    public function testDetailBook(): void 
    //retourne une erreur car le livre 0 n'existe pas
    {
        $client = static::createClient();
        $client->request('GET', '/books/0');

        self::assertResponseIsSuccessful();
    }


}