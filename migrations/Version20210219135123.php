<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219135123 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, product_category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D34A04ADBE6903FD (product_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_product_option (product_id INT NOT NULL, product_option_id INT NOT NULL, INDEX IDX_6B933F384584665A (product_id), INDEX IDX_6B933F38C964ABE2 (product_option_id), PRIMARY KEY(product_id, product_option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_attribute (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, storage_type VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_attribute_value (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, attribute_id INT NOT NULL, text_value LONGTEXT DEFAULT NULL, boolean_value TINYINT(1) DEFAULT NULL, integer_value INT DEFAULT NULL, float_value DOUBLE PRECISION DEFAULT NULL, datetime_value DATETIME DEFAULT NULL, date_value DATE DEFAULT NULL, json_value JSON DEFAULT NULL, INDEX IDX_CCC4BE1F4584665A (product_id), INDEX IDX_CCC4BE1FB6E62EFA (attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, product_category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, primary_category TINYINT(1) NOT NULL DEFAULT 0, INDEX IDX_CDFC7356BE6903FD (product_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_option (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_option_value (id INT AUTO_INCREMENT NOT NULL, product_option_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_A938C737C964ABE2 (product_option_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_variant (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, stock INT NOT NULL, width DOUBLE PRECISION DEFAULT NULL, height DOUBLE PRECISION DEFAULT NULL, depth DOUBLE PRECISION DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_209AA41D4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_variant_product_option_value (product_variant_id INT NOT NULL, product_option_value_id INT NOT NULL, INDEX IDX_612C6EDDA80EF684 (product_variant_id), INDEX IDX_612C6EDDEBDCCF9B (product_option_value_id), PRIMARY KEY(product_variant_id, product_option_value_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id)');
        $this->addSql('ALTER TABLE product_product_option ADD CONSTRAINT FK_6B933F384584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_product_option ADD CONSTRAINT FK_6B933F38C964ABE2 FOREIGN KEY (product_option_id) REFERENCES product_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_attribute_value ADD CONSTRAINT FK_CCC4BE1F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_attribute_value ADD CONSTRAINT FK_CCC4BE1FB6E62EFA FOREIGN KEY (attribute_id) REFERENCES product_attribute (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC7356BE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id)');
        $this->addSql('ALTER TABLE product_option_value ADD CONSTRAINT FK_A938C737C964ABE2 FOREIGN KEY (product_option_id) REFERENCES product_option (id)');
        $this->addSql('ALTER TABLE product_variant ADD CONSTRAINT FK_209AA41D4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_variant_product_option_value ADD CONSTRAINT FK_612C6EDDA80EF684 FOREIGN KEY (product_variant_id) REFERENCES product_variant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_variant_product_option_value ADD CONSTRAINT FK_612C6EDDEBDCCF9B FOREIGN KEY (product_option_value_id) REFERENCES product_option_value (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_product_option DROP FOREIGN KEY FK_6B933F384584665A');
        $this->addSql('ALTER TABLE product_attribute_value DROP FOREIGN KEY FK_CCC4BE1F4584665A');
        $this->addSql('ALTER TABLE product_variant DROP FOREIGN KEY FK_209AA41D4584665A');
        $this->addSql('ALTER TABLE product_attribute_value DROP FOREIGN KEY FK_CCC4BE1FB6E62EFA');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBE6903FD');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC7356BE6903FD');
        $this->addSql('ALTER TABLE product_product_option DROP FOREIGN KEY FK_6B933F38C964ABE2');
        $this->addSql('ALTER TABLE product_option_value DROP FOREIGN KEY FK_A938C737C964ABE2');
        $this->addSql('ALTER TABLE product_variant_product_option_value DROP FOREIGN KEY FK_612C6EDDEBDCCF9B');
        $this->addSql('ALTER TABLE product_variant_product_option_value DROP FOREIGN KEY FK_612C6EDDA80EF684');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_product_option');
        $this->addSql('DROP TABLE product_attribute');
        $this->addSql('DROP TABLE product_attribute_value');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE product_option');
        $this->addSql('DROP TABLE product_option_value');
        $this->addSql('DROP TABLE product_variant');
        $this->addSql('DROP TABLE product_variant_product_option_value');
    }
}
