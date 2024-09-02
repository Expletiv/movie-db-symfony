<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240902162616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change title column type to JSONB';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE movie_list SET title = \'{"en": "Title", "de": "Titel"}\'');
        $this->addSql('ALTER TABLE movie_list ALTER title TYPE JSONB USING title::JSONB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie_list ALTER title TYPE VARCHAR(255)');
        $this->addSql('UPDATE movie_list SET title = \'Title\'');
    }
}
