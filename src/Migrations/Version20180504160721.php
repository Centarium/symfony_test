<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180504160721 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE menu_items_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE menu_items (id INT NOT NULL, parent_id INT NOT NULL, name VARCHAR(40) NOT NULL, title TEXT DEFAULT NULL, route VARCHAR(40) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE invoice_details ALTER net_amount SET NOT NULL');
        $this->addSql('ALTER TABLE invoice_details ALTER tax_amount SET NOT NULL');
        $this->addSql('ALTER TABLE invoice_details ALTER gross_amount SET NOT NULL');
        $this->addSql('ALTER TABLE service ALTER default_price SET NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE menu_items_id_seq CASCADE');
        $this->addSql('DROP TABLE menu_items');
        $this->addSql('ALTER TABLE invoice_details ALTER net_amount DROP NOT NULL');
        $this->addSql('ALTER TABLE invoice_details ALTER tax_amount DROP NOT NULL');
        $this->addSql('ALTER TABLE invoice_details ALTER gross_amount DROP NOT NULL');
        $this->addSql('ALTER TABLE service ALTER default_price DROP NOT NULL');
    }
}
