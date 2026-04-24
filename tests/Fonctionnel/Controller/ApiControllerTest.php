<?php

namespace App\Tests\Fonctionnel\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testApiBook(): void 
    //à garder en minuscule
    {
        $client = static::createClient();
        $client->request('GET', '/api/books');

        self::assertResponseIsSuccessful();
    }

    public function testApiDetailBook(): void 
    //fonctionne si un livre à l'id 1
    {
        $client = static::createClient();
        $client->request('GET', '/api/books/1');

        self::assertResponseIsSuccessful();
    }

    public function testDetailErreurBook(): void 
    //retourne une erreur car le livre 0 n'existe pas
    {
        $client = static::createClient();
        $client->request('GET', '/api/books/0');

        self::assertResponseIsSuccessful();
    }


}