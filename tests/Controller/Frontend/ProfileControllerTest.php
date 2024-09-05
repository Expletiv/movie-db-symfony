<?php

namespace App\Tests\Controller\Frontend;

use App\Tests\Controller\AbstractWebTestCase;

class ProfileControllerTest extends AbstractWebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();

        $client->request('GET', '/en/profile');
        $this->assertResponseRedirects('/en/login', 302);

        $this->loginWithTestUser($client);

        $client->request('GET', '/en/profile');
        $this->assertResponseIsSuccessful();
    }
}
