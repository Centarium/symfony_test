<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416094213 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TYPE price_types AS ENUM (\'sad\', \'ok\', \'happy\')');
        //$this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product (id SERIAL NOT NULL, price NUMERIC(10, 2) NOT NULL, type price_types NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id) )');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TYPE price_types');
        $this->addSql('CREATE SCHEMA public');
        //$this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP TABLE product');
    }
}
