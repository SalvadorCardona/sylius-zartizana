<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220530143937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE MarketPlaceBankAccount (id INT AUTO_INCREMENT NOT NULL, iban VARCHAR(255) DEFAULT NULL, bic VARCHAR(255) DEFAULT NULL, bankName VARCHAR(255) DEFAULT NULL, MarketPlaceVendor_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_E7EABAB6994FBBFF (MarketPlaceVendor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE MarketPlaceBankAccount ADD CONSTRAINT FK_E7EABAB6994FBBFF FOREIGN KEY (MarketPlaceVendor_id) REFERENCES MarketPlaceVendor (id)');
        $this->addSql('ALTER TABLE MarketPlaceVendorAddress ADD firstName VARCHAR(255) DEFAULT NULL, ADD lastName VARCHAR(255) DEFAULT NULL, ADD phoneNumber VARCHAR(255) DEFAULT NULL, ADD company VARCHAR(255) DEFAULT NULL, ADD countryCode VARCHAR(255) DEFAULT NULL, ADD provinceCode VARCHAR(255) DEFAULT NULL, ADD provinceName VARCHAR(255) DEFAULT NULL, ADD street VARCHAR(255) DEFAULT NULL, ADD postcode VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE MarketPlaceBankAccount');
        $this->addSql('ALTER TABLE MarketPlaceVendorAddress DROP firstName, DROP lastName, DROP phoneNumber, DROP company, DROP countryCode, DROP provinceCode, DROP provinceName, DROP street, DROP postcode');
    }
}
