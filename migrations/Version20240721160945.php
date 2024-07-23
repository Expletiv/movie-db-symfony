<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240721160945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change movie table and add new movie_tmdb_data table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS movie');
        $this->addSql('DROP SEQUENCE IF EXISTS movie_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE movie_tmdb_data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE movie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE movie (id INT NOT NULL, tmdb_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, release_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, popularity DOUBLE PRECISION NOT NULL, likes INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX movie_popularity_idx ON movie (popularity)');
        $this->addSql('CREATE UNIQUE INDEX movie_unique_idx ON movie (tmdb_id)');
        $this->addSql('COMMENT ON COLUMN movie.release_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE movie_tmdb_data (id INT NOT NULL, movie_id INT NOT NULL, locale VARCHAR(2) NOT NULL, title VARCHAR(255) DEFAULT NULL, tmdb_data JSON NOT NULL, tmdb_details_data JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9F4C88D98F93B6FC ON movie_tmdb_data (movie_id)');
        $this->addSql('ALTER TABLE movie_tmdb_data ADD CONSTRAINT FK_9F4C88D98F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE movie_tmdb_data_id_seq CASCADE');
        $this->addSql('ALTER TABLE movie_tmdb_data DROP CONSTRAINT FK_9F4C88D98F93B6FC');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movie_tmdb_data');
    }
}
