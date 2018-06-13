<?php

namespace TruckBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DealerControllerTest extends WebTestCase
{
    public function testTestdealer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/testDealer');
    }

}
