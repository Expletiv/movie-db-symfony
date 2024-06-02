<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240602175001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add likes to movie';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie ADD likes INT NOT NULL DEFAULT 0');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie DROP likes');
    }
}
