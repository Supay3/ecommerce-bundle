<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210211165129 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD product_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADBE6903FD ON product (product_category_id)');
        $this->addSql('ALTER TABLE product_product_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE product_product_option ADD PRIMARY KEY (product_id, product_option_id)');
        $this->addSql('ALTER TABLE product_product_option RENAME INDEX idx_98d76df44584665a TO IDX_6B933F384584665A');
        $this->addSql('ALTER TABLE product_product_option RENAME INDEX idx_98d76df4c964abe2 TO IDX_6B933F38C964ABE2');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBE6903FD');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP INDEX IDX_D34A04ADBE6903FD ON product');
        $this->addSql('ALTER TABLE product DROP product_category_id');
        $this->addSql('ALTER TABLE product_product_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE product_product_option ADD PRIMARY KEY (product_option_id, product_id)');
        $this->addSql('ALTER TABLE product_product_option RENAME INDEX idx_6b933f38c964abe2 TO IDX_98D76DF4C964ABE2');
        $this->addSql('ALTER TABLE product_product_option RENAME INDEX idx_6b933f384584665a TO IDX_98D76DF44584665A');
    }
}
