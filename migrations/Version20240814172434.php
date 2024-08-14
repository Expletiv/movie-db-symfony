<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240814172434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add email_log table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE email_log_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE email_log (id INT NOT NULL, subject VARCHAR(255) DEFAULT NULL, sent_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, sender VARCHAR(180) DEFAULT NULL, recipient VARCHAR(180) DEFAULT NULL, html TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN email_log.sent_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE email_log_id_seq CASCADE');
        $this->addSql('DROP TABLE email_log');
    }
}
