<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240610164133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add tmdb_data and tmdb_details_data to movies';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE movie ADD tmdb_data jsonb NOT NULL DEFAULT '{}'");
        $this->addSql("ALTER TABLE movie ADD tmdb_details_data jsonb NOT NULL DEFAULT '{}'");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie DROP tmdb_data');
        $this->addSql('ALTER TABLE movie DROP tmdb_details_data');
    }
}
