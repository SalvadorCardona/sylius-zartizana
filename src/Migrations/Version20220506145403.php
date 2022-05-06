<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506145403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE MarketPlaceVendorAddress (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) DEFAULT NULL, marketplaceVendor_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_1332F144ED7932C (marketplaceVendor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE MarketPlaceVendorAddress ADD CONSTRAINT FK_1332F144ED7932C FOREIGN KEY (marketplaceVendor_id) REFERENCES MarketplaceVendor (id)');
        $this->addSql('ALTER TABLE MarketplaceVendor CHANGE id id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE MarketPlaceVendorAddress');
        $this->addSql('ALTER TABLE MarketplaceVendor CHANGE id id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
    }
}
