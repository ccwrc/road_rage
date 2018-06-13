<?php

namespace TruckBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DocumentControllerTest extends WebTestCase
{
    public function testCreateandsendpg()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/createAndSendPg');
    }

    public function testCreateandsendro()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/createAndSendRo');
    }

    public function testCreateandsendwpg()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/createAndSendWpg');
    }

    public function testCreateandsendwro()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/createAndSendWro');
    }

}
