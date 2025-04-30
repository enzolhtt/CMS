<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250430071801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD statut VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD statut VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE page ADD statut VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP statut');
        $this->addSql('ALTER TABLE commentaire DROP statut');
        $this->addSql('ALTER TABLE page DROP statut');
    }
}
