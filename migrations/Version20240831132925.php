<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240831132925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add movies page table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE movies_page (id SERIAL NOT NULL, type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_470319EA8CDE5729 ON movies_page (type)');
        $this->addSql('CREATE TABLE movies_page_list (id SERIAL NOT NULL, page_id INT NOT NULL, list_id INT NOT NULL, position INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EBE628F3C4663E4 ON movies_page_list (page_id)');
        $this->addSql('CREATE INDEX IDX_EBE628F33DAE168B ON movies_page_list (list_id)');
        $this->addSql('CREATE INDEX IDX_EBE628F3462CE4F5 ON movies_page_list (position)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EBE628F3C4663E43DAE168B ON movies_page_list (page_id, list_id)');
        $this->addSql('ALTER TABLE movies_page_list ADD CONSTRAINT FK_EBE628F3C4663E4 FOREIGN KEY (page_id) REFERENCES movies_page (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE movies_page_list ADD CONSTRAINT FK_EBE628F33DAE168B FOREIGN KEY (list_id) REFERENCES movie_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movies_page_list DROP CONSTRAINT FK_EBE628F3C4663E4');
        $this->addSql('ALTER TABLE movies_page_list DROP CONSTRAINT FK_EBE628F33DAE168B');
        $this->addSql('DROP TABLE movies_page');
        $this->addSql('DROP TABLE movies_page_list');
    }
}
