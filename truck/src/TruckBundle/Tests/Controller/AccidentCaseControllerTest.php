<?php

namespace TruckBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccidentCaseControllerTest extends WebTestCase
{
    public function testTestcase()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/testCase');
    }

}
