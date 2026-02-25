<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260225153749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, minimum_jet INT NOT NULL, description LONGTEXT DEFAULT NULL, est_gagnee TINYINT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE carte (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, est_activee TINYINT NOT NULL, statut VARCHAR(50) DEFAULT NULL, description LONGTEXT DEFAULT NULL, est_fusionnable TINYINT NOT NULL, est_fusionnee TINYINT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE categorie_action (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE categorie_carte (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE extension (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, limite_de_tour INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE fusion (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, nbre_joueurs INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE personnage (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(20) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE personnage_dialogue (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(20) NOT NULL, dialogue LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tour (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE carte');
        $this->addSql('DROP TABLE categorie_action');
        $this->addSql('DROP TABLE categorie_carte');
        $this->addSql('DROP TABLE extension');
        $this->addSql('DROP TABLE fusion');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE personnage');
        $this->addSql('DROP TABLE personnage_dialogue');
        $this->addSql('DROP TABLE tour');
    }
}
