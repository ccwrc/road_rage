<?php

namespace TruckBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OperatorControllerTest extends WebTestCase
{
    public function testOperator()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Operator');
    }

}
