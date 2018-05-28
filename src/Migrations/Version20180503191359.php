<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180503191359 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE invoice_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE invoice_details_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE history_history_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE invoice (id INT NOT NULL, client_id INT NOT NULL, create_user INT NOT NULL, invoice_nr VARCHAR(40) NOT NULL, comment TEXT NOT NULL, timestamp TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9065174419EB6921 ON invoice (client_id)');
        $this->addSql('CREATE INDEX IDX_90651744C324B20 ON invoice (create_user)');
        $this->addSql('CREATE TABLE invoice_details (id INT NOT NULL, invoice_id INT NOT NULL, net_amount money, tax_amount money, gross_amount money, qty INT NOT NULL, tax_rate INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_80FF3D592989F1FD ON invoice_details (invoice_id)');
        $this->addSql('CREATE TABLE client (client_id INT NOT NULL, create_user INT NOT NULL, name VARCHAR(60) NOT NULL, gln VARCHAR(20) NOT NULL, timestamp TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, juridical_address VARCHAR(60) NOT NULL, physical_address VARCHAR(60) NOT NULL, PRIMARY KEY(client_id))');
        $this->addSql('CREATE INDEX IDX_C7440455C324B20 ON client (create_user)');
        $this->addSql('CREATE TABLE history (history_id INT NOT NULL, create_user INT NOT NULL, "table" VARCHAR(30) NOT NULL, field VARCHAR(30) NOT NULL, field_id INT NOT NULL, old_value INT NOT NULL, new_value INT NOT NULL, timestamp TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(history_id))');
        $this->addSql('CREATE INDEX IDX_27BA704BC324B20 ON history (create_user)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174419EB6921 FOREIGN KEY (client_id) REFERENCES client (client_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744C324B20 FOREIGN KEY (create_user) REFERENCES app_users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice_details ADD CONSTRAINT FK_80FF3D592989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455C324B20 FOREIGN KEY (create_user) REFERENCES app_users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BC324B20 FOREIGN KEY (create_user) REFERENCES app_users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE invoice_details DROP CONSTRAINT FK_80FF3D592989F1FD');
        $this->addSql('ALTER TABLE invoice DROP CONSTRAINT FK_9065174419EB6921');
        $this->addSql('DROP SEQUENCE invoice_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE invoice_details_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE history_history_id_seq CASCADE');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_details');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE history');
    }
}
