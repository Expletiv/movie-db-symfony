<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240902174249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change movies_page title column type to JSONB';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE movies_page SET title = \'{"en": "Title", "de": "Titel"}\'');
        $this->addSql('ALTER TABLE movies_page ALTER title TYPE JSONB USING title::JSONB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movies_page ALTER title TYPE VARCHAR(255)');
        $this->addSql('UPDATE movies_page SET title = \'Title\'');
    }
}
