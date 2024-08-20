<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class DtoGenerateCommandTest extends KernelTestCase
{
    public function testExecution(): void
    {
        self::bootKernel();

        $application = new Application(self::$kernel);
        $command = $application->find('app:dto:generate');

        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'from' => 'dto/tmdb-openapi.json',
            'to' => 'src/Dto',
            '--dry-run' => true,
        ]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('DTOs generated', $output);
    }
}
