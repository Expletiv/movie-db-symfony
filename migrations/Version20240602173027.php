<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240602173027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rename some colums in table movie';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie RENAME COLUMN name TO title');
        $this->addSql('ALTER TABLE movie RENAME COLUMN released_at TO release_date');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE movie RENAME COLUMN title TO name');
        $this->addSql('ALTER TABLE movie RENAME COLUMN release_date TO released_at');
    }
}
