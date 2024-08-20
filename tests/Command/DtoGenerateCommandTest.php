<?php

namespace App\Tests\Command;

use InvalidArgumentException;
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
        $this->assertStringContainsString('Generation of DTOs and Clients completed', $output);
    }

    public function testFailure(): void
    {
        self::bootKernel();

        $application = new Application(self::$kernel);
        $command = $application->find('app:dto:generate');

        $commandTester = new CommandTester($command);

        $this->expectException(InvalidArgumentException::class);
        $commandTester->execute([
            'from' => 'dto/iamnojson.txt',
            'to' => 'src/Dto',
            '--dry-run' => true,
        ]);
        $this->assertEquals(1, $commandTester->getStatusCode());

        $this->expectException(InvalidArgumentException::class);
        $commandTester->execute([
            'from' => 'dto/tmdb-openapi.json',
            'to' => 'no valid path',
            '--dry-run' => true,
        ]);
        $this->assertEquals(1, $commandTester->getStatusCode());

        $this->expectException(InvalidArgumentException::class);
        $commandTester->execute([
            'from' => 'dto/tmdb-openapi.json',
            'to' => 'src/IDontExist',
            '--dry-run' => false,
        ]);
        $this->assertEquals(1, $commandTester->getStatusCode());
    }
}
