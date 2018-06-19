<?php

namespace BooksBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReportControllerTest extends WebTestCase
{
    public function testMinor()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/minor');
    }

    public function testMayor()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/mayor');
    }

}
