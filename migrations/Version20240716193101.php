<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240716193101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add locale to movie';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX uniq_1d5ef26f55bcc5e5');
        $this->addSql('ALTER TABLE movie ADD locale VARCHAR(2) NOT NULL DEFAULT \'en\'');
        $this->addSql('ALTER TABLE movie ALTER locale DROP DEFAULT');
        $this->addSql('CREATE UNIQUE INDEX movie_unique_idx ON movie (tmdb_id, locale)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX movie_unique_idx');
        $this->addSql('ALTER TABLE movie DROP locale');
        $this->addSql('CREATE UNIQUE INDEX uniq_1d5ef26f55bcc5e5 ON movie (tmdb_id)');
    }
}
