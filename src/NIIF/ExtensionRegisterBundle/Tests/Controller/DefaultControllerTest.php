<?php

namespace NIIF\ExtensionRegisterBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testGetextension()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getExtension');
    }

    public function testGethealth()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getHealth');
    }
}
