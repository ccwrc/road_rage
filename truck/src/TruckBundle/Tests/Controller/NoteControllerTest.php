<?php

namespace TruckBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NoteControllerTest extends WebTestCase
{
    public function testCreatenote()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/createNote');
    }

    public function testShowpublicnotes()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showPublicNotes');
    }

    public function testShowusernotes()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showUserNotes');
    }

    public function testEditnote()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editNote');
    }

    public function testDeletenote()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteNote');
    }

}
