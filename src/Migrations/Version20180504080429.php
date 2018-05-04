<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180504080429 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, service_name VARCHAR(50) NOT NULL, default_price money, period INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE invoice_details ADD service_id INT NOT NULL');
        $this->addSql('ALTER TABLE invoice_details ADD CONSTRAINT FK_80FF3D59ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_80FF3D59ED5CA9E6 ON invoice_details (service_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE invoice_details DROP CONSTRAINT FK_80FF3D59ED5CA9E6');
        $this->addSql('DROP SEQUENCE service_id_seq CASCADE');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP INDEX IDX_80FF3D59ED5CA9E6');
        $this->addSql('ALTER TABLE invoice_details DROP service_id');
    }
}
