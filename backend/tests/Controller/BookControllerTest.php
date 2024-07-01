<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Uid\Uuid;

class BookControllerTest extends WebTestCase
{
    public function testWhenGettingAllBooks_thenReturnOK(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/books');

        $this->assertResponseIsSuccessful();

        //
        $response = $client->getResponse();
        $data = $response->getContent();
        $this->assertStringContainsString("Five Shades of Black", $data);
    }

    public function testWhenGettingNonExistingBook_thenReturn404Status(): void
    {
        $client = static::createClient();
        $id = Uuid::v4();
        $crawler = $client->jsonRequest('GET', '/books/' . $id);

        //
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(404);
        $data = $response->getContent();
        $this->assertStringContainsString("Book #" . $id . " was not found", $data);
    }
}
