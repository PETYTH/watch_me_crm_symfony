<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214101144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD employe_id INT DEFAULT NULL, ADD entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404551B65292 FOREIGN KEY (employe_id) REFERENCES employes (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_C74404551B65292 ON client (employe_id)');
        $this->addSql('CREATE INDEX IDX_C7440455A4AEAFEA ON client (entreprise_id)');
        $this->addSql('ALTER TABLE employes ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employes ADD CONSTRAINT FK_A94BC0F0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A94BC0F0A76ED395 ON employes (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404551B65292');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A4AEAFEA');
        $this->addSql('DROP INDEX IDX_C74404551B65292 ON client');
        $this->addSql('DROP INDEX IDX_C7440455A4AEAFEA ON client');
        $this->addSql('ALTER TABLE client DROP employe_id, DROP entreprise_id');
        $this->addSql('ALTER TABLE employes DROP FOREIGN KEY FK_A94BC0F0A76ED395');
        $this->addSql('DROP INDEX IDX_A94BC0F0A76ED395 ON employes');
        $this->addSql('ALTER TABLE employes DROP user_id');
    }
}
