<?php

namespace TruckBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use TruckBundle\Controller\DocumentController;

class DocumentControllerTest extends WebTestCase
{

    public function testGetEmailsFromString()
    {
        $string = <<<'STRING'
iqawdgkauwdg mail1@oo.pl;;;;;;mail2@pp.ll ''''''';::::mail3@oo.aa]]]]]
  mail4@uuu.pl-fakemail#pp.pl,,mail5@www.pl ..???///mail6@ww.aa
  \\[]@mail7@qaaa.pp
STRING;
        $this->assertCount(7, DocumentController::getEmailsFromString($string));
    }
}
