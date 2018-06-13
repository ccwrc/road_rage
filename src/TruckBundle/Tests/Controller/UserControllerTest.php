<?php

namespace TruckBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testAddroletouser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addRoleToUser');
    }

    public function testRemoverolefromuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/removeRoleFromUser');
    }

    public function testDeleteuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteUser');
    }

    public function testShowuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showUser');
    }

    public function testShowallusers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showAllUsers');
    }

    public function testFinduser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/findUser');
    }

}
