<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240711204542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add popularity to movies';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie ADD popularity DOUBLE PRECISION NOT NULL DEFAULT -1');
        // Drop defaults as they are not needed anymore
        $this->addSql('ALTER TABLE movie ALTER likes DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER tmdb_data DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER tmdb_details_data DROP DEFAULT');
        $this->addSql('CREATE INDEX popularity_idx ON movie (popularity)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX popularity_idx');
        $this->addSql('ALTER TABLE movie DROP popularity');
        $this->addSql('ALTER TABLE movie ALTER likes SET DEFAULT 0');
        $this->addSql('ALTER TABLE movie ALTER tmdb_data SET DEFAULT \'{}\'');
        $this->addSql('ALTER TABLE movie ALTER tmdb_details_data SET DEFAULT \'{}\'');
    }
}
