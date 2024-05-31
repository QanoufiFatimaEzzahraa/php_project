<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526142628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compte_bancaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, solde DOUBLE PRECISION NOT NULL, actif TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, date_cloture DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte_caisse (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, solde DOUBLE PRECISION NOT NULL, actif TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, date_cloture DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte_credit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, solde DOUBLE PRECISION NOT NULL, actif TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, date_cloture DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE compte_bancaire');
        $this->addSql('DROP TABLE compte_caisse');
        $this->addSql('DROP TABLE compte_credit');
    }
}
