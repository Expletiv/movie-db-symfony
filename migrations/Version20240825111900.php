<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240825111900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add movie list table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE movie_list (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE movie_list_item (id SERIAL NOT NULL, movie_id INT NOT NULL, movie_list_id INT NOT NULL, position INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C900F3F18F93B6FC ON movie_list_item (movie_id)');
        $this->addSql('CREATE INDEX IDX_C900F3F11D3854A5 ON movie_list_item (movie_list_id)');
        $this->addSql('CREATE INDEX IDX_C900F3F1462CE4F5 ON movie_list_item (position)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C900F3F18F93B6FC1D3854A5 ON movie_list_item (movie_id, movie_list_id)');
        $this->addSql('ALTER TABLE movie_list_item ADD CONSTRAINT FK_C900F3F18F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE movie_list_item ADD CONSTRAINT FK_C900F3F11D3854A5 FOREIGN KEY (movie_list_id) REFERENCES movie_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie_list_item DROP CONSTRAINT FK_C900F3F18F93B6FC');
        $this->addSql('ALTER TABLE movie_list_item DROP CONSTRAINT FK_C900F3F11D3854A5');
        $this->addSql('DROP TABLE movie_list');
        $this->addSql('DROP TABLE movie_list_item');
    }
}
