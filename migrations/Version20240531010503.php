<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531010503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_credit ADD type VARCHAR(50) NOT NULL, ADD nom_banque VARCHAR(100) NOT NULL, ADD name VARCHAR(100) NOT NULL, ADD expiration_date VARCHAR(5) NOT NULL, ADD cvv VARCHAR(4) NOT NULL, ADD credit_limit DOUBLE PRECISION NOT NULL, ADD available_credit DOUBLE PRECISION NOT NULL, ADD minimum_payment DOUBLE PRECISION NOT NULL, ADD interest_rate DOUBLE PRECISION NOT NULL, DROP nom, DROP solde, DROP actif, DROP date_cloture, DROP limite_credit, DROP taux_interet, DROP paiement_minimum, CHANGE date_creation created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_credit ADD nom VARCHAR(255) NOT NULL, ADD solde DOUBLE PRECISION NOT NULL, ADD actif TINYINT(1) NOT NULL, ADD date_cloture DATETIME DEFAULT NULL, ADD limite_credit DOUBLE PRECISION NOT NULL, ADD taux_interet DOUBLE PRECISION NOT NULL, ADD paiement_minimum DOUBLE PRECISION NOT NULL, DROP type, DROP nom_banque, DROP name, DROP expiration_date, DROP cvv, DROP credit_limit, DROP available_credit, DROP minimum_payment, DROP interest_rate, CHANGE created_at date_creation DATETIME NOT NULL');
    }
}
