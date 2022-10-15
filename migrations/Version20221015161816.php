<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221015161816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE todos ALTER id TYPE INT');
        $this->addSql('ALTER TABLE todos ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE todos ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE todos ALTER is_done TYPE BOOLEAN');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE todos ALTER id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE todos ALTER description TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE todos ALTER is_done TYPE VARCHAR(255)');
    }
}
