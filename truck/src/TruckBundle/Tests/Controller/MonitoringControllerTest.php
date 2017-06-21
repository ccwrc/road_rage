<?php

namespace TruckBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MonitoringControllerTest extends WebTestCase
{
    public function testTestmon()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/testMon');
    }

}
