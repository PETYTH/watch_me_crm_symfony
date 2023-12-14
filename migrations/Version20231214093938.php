<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214093938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_has_entreprise DROP FOREIGN KEY FK_CA98417C846BCE88');
        $this->addSql('ALTER TABLE client_has_entreprise DROP FOREIGN KEY FK_CA98417C19EB6921');
        $this->addSql('ALTER TABLE user_has_entreprise DROP FOREIGN KEY FK_80DEDCAA67B3B43D');
        $this->addSql('ALTER TABLE user_has_entreprise DROP FOREIGN KEY FK_80DEDCAAA4AEAFEA');
        $this->addSql('DROP TABLE client_has_entreprise');
        $this->addSql('DROP TABLE user_has_entreprise');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_has_entreprise (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, entreprise_client_id INT DEFAULT NULL, INDEX IDX_CA98417C19EB6921 (client_id), INDEX IDX_CA98417C846BCE88 (entreprise_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_has_entreprise (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, entreprise_id INT DEFAULT NULL, INDEX IDX_80DEDCAAA4AEAFEA (entreprise_id), INDEX IDX_80DEDCAA67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE client_has_entreprise ADD CONSTRAINT FK_CA98417C846BCE88 FOREIGN KEY (entreprise_client_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE client_has_entreprise ADD CONSTRAINT FK_CA98417C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE user_has_entreprise ADD CONSTRAINT FK_80DEDCAA67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_has_entreprise ADD CONSTRAINT FK_80DEDCAAA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
    }
}
