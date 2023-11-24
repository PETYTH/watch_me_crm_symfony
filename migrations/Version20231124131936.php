<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124131936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_has_entreprise (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, entreprise_client_id INT DEFAULT NULL, INDEX IDX_CA98417C19EB6921 (client_id), INDEX IDX_CA98417C846BCE88 (entreprise_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, commande_client_id INT DEFAULT NULL, numero INT NOT NULL, date DATE NOT NULL, paiement DOUBLE PRECISION NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_35D4282C9E73363 (commande_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employes (id INT AUTO_INCREMENT NOT NULL, employes_entreprise_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_A94BC0F0B4C490EC (employes_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, numero_siret INT NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(255) NOT NULL, chiffre_affaire INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, produit_stock_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_BE2DDF8C24D25303 (produit_stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stocks (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) NOT NULL, nombre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(150) NOT NULL, firstname VARCHAR(150) NOT NULL, birthday DATE NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_has_entreprise (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, entreprise_id INT DEFAULT NULL, INDEX IDX_80DEDCAA67B3B43D (users_id), INDEX IDX_80DEDCAAA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_has_entreprise ADD CONSTRAINT FK_CA98417C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client_has_entreprise ADD CONSTRAINT FK_CA98417C846BCE88 FOREIGN KEY (entreprise_client_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C9E73363 FOREIGN KEY (commande_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE employes ADD CONSTRAINT FK_A94BC0F0B4C490EC FOREIGN KEY (employes_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C24D25303 FOREIGN KEY (produit_stock_id) REFERENCES stocks (id)');
        $this->addSql('ALTER TABLE user_has_entreprise ADD CONSTRAINT FK_80DEDCAA67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_has_entreprise ADD CONSTRAINT FK_80DEDCAAA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_has_entreprise DROP FOREIGN KEY FK_CA98417C19EB6921');
        $this->addSql('ALTER TABLE client_has_entreprise DROP FOREIGN KEY FK_CA98417C846BCE88');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C9E73363');
        $this->addSql('ALTER TABLE employes DROP FOREIGN KEY FK_A94BC0F0B4C490EC');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C24D25303');
        $this->addSql('ALTER TABLE user_has_entreprise DROP FOREIGN KEY FK_80DEDCAA67B3B43D');
        $this->addSql('ALTER TABLE user_has_entreprise DROP FOREIGN KEY FK_80DEDCAAA4AEAFEA');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_has_entreprise');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE employes');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE stocks');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_has_entreprise');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
