<?php

namespace App\Tests\Controller\Frontend\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testLoginSuccess(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/login');
        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Sign in')->form([
            '_username' => 'test.user@mail.com',
            '_password' => 'password',
        ]);

        $client->setServerParameter('HTTP_REFERER', '/en/home');
        $client->submit($form);
        $this->assertResponseRedirects('/en/home', 302);
    }

    public function testLoginFailure(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/login');
        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Sign in')->form([
            '_username' => 'test.user@mail.com',
            '_password' => 'wrong-password',
        ]);

        $client->setServerParameter('HTTP_REFERER', '/en/home');
        $client->submit($form);
        $this->assertResponseRedirects('/en/login', 302);
    }
}
