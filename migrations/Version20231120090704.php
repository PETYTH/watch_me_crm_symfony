<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120090704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, id_client INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, adresse VARCHAR(255) NOT NULL, code_postale INT NOT NULL, ville VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_has_entreprise (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_CA98417C19EB6921 (client_id), INDEX IDX_CA98417CA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employes (id INT AUTO_INCREMENT NOT NULL, employes_id_entreprise_id INT NOT NULL, id_employe INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_A94BC0F0EBB2A057 (employes_id_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, entreprise_id_entreprise_id INT NOT NULL, id_entreprise INT NOT NULL, nom VARCHAR(255) NOT NULL, numero_siret INT NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(255) NOT NULL, chiffre_affaire INT NOT NULL, INDEX IDX_D19FA603260408F (entreprise_id_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, id_produit INT NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stocks (id INT AUTO_INCREMENT NOT NULL, id_stock INT NOT NULL, numero VARCHAR(255) NOT NULL, nombre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(150) NOT NULL, firstname VARCHAR(150) NOT NULL, birthday DATE NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_has_entreprise (id INT AUTO_INCREMENT NOT NULL, users_id_users_id INT NOT NULL, INDEX IDX_80DEDCAAC0DD645A (users_id_users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_has_entreprise ADD CONSTRAINT FK_CA98417C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client_has_entreprise ADD CONSTRAINT FK_CA98417CA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE employes ADD CONSTRAINT FK_A94BC0F0EBB2A057 FOREIGN KEY (employes_id_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA603260408F FOREIGN KEY (entreprise_id_entreprise_id) REFERENCES user_has_entreprise (id)');
        $this->addSql('ALTER TABLE user_has_entreprise ADD CONSTRAINT FK_80DEDCAAC0DD645A FOREIGN KEY (users_id_users_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_has_entreprise DROP FOREIGN KEY FK_CA98417C19EB6921');
        $this->addSql('ALTER TABLE client_has_entreprise DROP FOREIGN KEY FK_CA98417CA4AEAFEA');
        $this->addSql('ALTER TABLE employes DROP FOREIGN KEY FK_A94BC0F0EBB2A057');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA603260408F');
        $this->addSql('ALTER TABLE user_has_entreprise DROP FOREIGN KEY FK_80DEDCAAC0DD645A');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_has_entreprise');
        $this->addSql('DROP TABLE employes');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE stocks');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_has_entreprise');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
