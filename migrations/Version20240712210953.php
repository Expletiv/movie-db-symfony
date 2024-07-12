<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240712210953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add is_verified to user and drop default movie popularity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie ALTER popularity DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ADD is_verified BOOLEAN NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie ALTER popularity SET DEFAULT \'-1\'');
        $this->addSql('ALTER TABLE "user" DROP is_verified');
    }
}
