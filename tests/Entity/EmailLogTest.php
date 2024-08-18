<?php

namespace App\Tests\Entity;

use App\Entity\EmailLog;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class EmailLogTest extends TestCase
{
    public function testEmailLog(): void
    {
        $emailLog = new EmailLog();

        $emailLog->setId(1);
        $emailLog->setSubject('Test Subject');
        $emailLog->setSentAt(new DateTimeImmutable('2021-01-01 00:00:00'));
        $emailLog->setSender('Foo');
        $emailLog->setRecipient('Bar');

        $this->assertEquals(1, $emailLog->getId());
        $this->assertEquals('Test Subject', $emailLog->getSubject());
        $this->assertEquals(new DateTimeImmutable('2021-01-01 00:00:00'), $emailLog->getSentAt());
        $this->assertEquals('Foo', $emailLog->getSender());
        $this->assertEquals('Bar', $emailLog->getRecipient());

        $emailLog->setHtml('<p>Test</p>');
        $this->assertEquals('<p>Test</p>', $emailLog->getHtml());
    }
}
