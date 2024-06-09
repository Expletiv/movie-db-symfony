<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240609183706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add tmdbId to table movie';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie ADD tmdb_id INT');
        $this->addSql('UPDATE movie SET tmdb_id = id');
        $this->addSql('ALTER TABLE movie ALTER COLUMN tmdb_id SET NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D5EF26F55BCC5E5 ON movie (tmdb_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_1D5EF26F55BCC5E5');
        $this->addSql('ALTER TABLE movie DROP tmdb_id');
    }
}
