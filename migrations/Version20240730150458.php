<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240730150458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add movie watchlist table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_watchlist (id UUID NOT NULL, owner_id INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A7D681D57E3C61F9 ON movie_watchlist (owner_id)');
        $this->addSql('COMMENT ON COLUMN movie_watchlist.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE movie_watchlist_movie (movie_watchlist_id UUID NOT NULL, movie_id INT NOT NULL, PRIMARY KEY(movie_watchlist_id, movie_id))');
        $this->addSql('CREATE INDEX IDX_861BA7EDA02BECA7 ON movie_watchlist_movie (movie_watchlist_id)');
        $this->addSql('CREATE INDEX IDX_861BA7ED8F93B6FC ON movie_watchlist_movie (movie_id)');
        $this->addSql('COMMENT ON COLUMN movie_watchlist_movie.movie_watchlist_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE movie_watchlist ADD CONSTRAINT FK_A7D681D57E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE movie_watchlist_movie ADD CONSTRAINT FK_861BA7EDA02BECA7 FOREIGN KEY (movie_watchlist_id) REFERENCES movie_watchlist (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE movie_watchlist_movie ADD CONSTRAINT FK_861BA7ED8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie_watchlist DROP CONSTRAINT FK_A7D681D57E3C61F9');
        $this->addSql('ALTER TABLE movie_watchlist_movie DROP CONSTRAINT FK_861BA7EDA02BECA7');
        $this->addSql('ALTER TABLE movie_watchlist_movie DROP CONSTRAINT FK_861BA7ED8F93B6FC');
        $this->addSql('DROP TABLE movie_watchlist');
        $this->addSql('DROP TABLE movie_watchlist_movie');
    }
}
