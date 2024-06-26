<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530234448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_caisse ADD nom_titulaire VARCHAR(255) NOT NULL, DROP actif, DROP date_cloture, CHANGE nom nom_banque VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_caisse ADD nom VARCHAR(255) NOT NULL, ADD actif TINYINT(1) NOT NULL, ADD date_cloture DATETIME DEFAULT NULL, DROP nom_banque, DROP nom_titulaire');
    }
}
