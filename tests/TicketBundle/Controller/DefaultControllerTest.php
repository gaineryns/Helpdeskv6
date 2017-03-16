<?php

namespace TicketBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/t');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
