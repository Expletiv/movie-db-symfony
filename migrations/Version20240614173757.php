<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240614173757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make title and release_date of movies nullable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie ALTER title DROP NOT NULL');
        $this->addSql('ALTER TABLE movie ALTER release_date DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie ALTER title SET NOT NULL');
        $this->addSql('ALTER TABLE movie ALTER release_date SET NOT NULL');
    }
}
