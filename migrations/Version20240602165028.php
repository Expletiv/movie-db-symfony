<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240602165028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds table movie to the database';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE movie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE movie (id INT NOT NULL, name VARCHAR(255) NOT NULL, released_at TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN movie.released_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE movie_id_seq CASCADE');
        $this->addSql('DROP TABLE movie');
    }
}
