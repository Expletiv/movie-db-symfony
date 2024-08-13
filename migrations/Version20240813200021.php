<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240813200021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'CHANGE tmdbData types to JSONB';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie_tmdb_data ALTER COLUMN tmdb_data SET DATA TYPE JSONB USING tmdb_data::JSONB');
        $this->addSql('ALTER TABLE movie_tmdb_data ALTER COLUMN tmdb_details_data SET DATA TYPE JSONB USING tmdb_details_data::JSONB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie_tmdb_data ALTER COLUMN tmdb_data SET DATA TYPE JSON USING tmdb_data::TEXT::JSON');
        $this->addSql('ALTER TABLE movie_tmdb_data ALTER COLUMN tmdb_details_data SET DATA TYPE JSON USING tmdb_details_data::TEXT::JSON');
    }
}
