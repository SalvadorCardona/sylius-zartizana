<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606125816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE MarketPlaceVendor DROP FOREIGN KEY FK_744AD8366C4BC14C');
        $this->addSql('CREATE TABLE MarketPlaceStore (id INT AUTO_INCREMENT NOT NULL, firstName VARCHAR(255) DEFAULT NULL, lastName VARCHAR(255) DEFAULT NULL, phoneNumber VARCHAR(255) DEFAULT NULL, countryCode VARCHAR(4) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, postalCode VARCHAR(255) DEFAULT NULL, streetNumber INT DEFAULT NULL, marketPlaceVendor_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_29AA55A383B3EBF4 (marketPlaceVendor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE MarketPlaceStore ADD CONSTRAINT FK_29AA55A383B3EBF4 FOREIGN KEY (marketPlaceVendor_id) REFERENCES MarketPlaceVendor (id)');
        $this->addSql('DROP TABLE MarketPlaceVendorAddress');
        $this->addSql('DROP INDEX UNIQ_744AD8366C4BC14C ON MarketPlaceVendor');
        $this->addSql('ALTER TABLE MarketPlaceVendor ADD siret VARCHAR(255) DEFAULT NULL, ADD profilePicture VARCHAR(255) DEFAULT NULL, ADD phoneNumber VARCHAR(255) DEFAULT NULL, CHANGE marketplacevendoraddress_id mainTaxon_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE MarketPlaceVendor ADD CONSTRAINT FK_744AD836A766DEB2 FOREIGN KEY (mainTaxon_id) REFERENCES sylius_taxon (id)');
        $this->addSql('CREATE INDEX IDX_744AD836A766DEB2 ON MarketPlaceVendor (mainTaxon_id)');
        $this->addSql('ALTER TABLE sylius_product_variant ADD marketPlaceVendor_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE sylius_product_variant ADD CONSTRAINT FK_A29B52383B3EBF4 FOREIGN KEY (marketPlaceVendor_id) REFERENCES MarketPlaceVendor (id)');
        $this->addSql('CREATE INDEX IDX_A29B52383B3EBF4 ON sylius_product_variant (marketPlaceVendor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE MarketPlaceVendorAddress (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, firstName VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, lastName VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, phoneNumber VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, company VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, countryCode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, provinceCode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, provinceName VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, street VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, postcode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE MarketPlaceStore');
        $this->addSql('ALTER TABLE MarketPlaceVendor DROP FOREIGN KEY FK_744AD836A766DEB2');
        $this->addSql('DROP INDEX IDX_744AD836A766DEB2 ON MarketPlaceVendor');
        $this->addSql('ALTER TABLE MarketPlaceVendor DROP siret, DROP profilePicture, DROP phoneNumber, CHANGE maintaxon_id marketPlaceVendorAddress_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE MarketPlaceVendor ADD CONSTRAINT FK_744AD8366C4BC14C FOREIGN KEY (marketPlaceVendorAddress_id) REFERENCES MarketPlaceVendorAddress (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_744AD8366C4BC14C ON MarketPlaceVendor (marketPlaceVendorAddress_id)');
        $this->addSql('ALTER TABLE sylius_product_variant DROP FOREIGN KEY FK_A29B52383B3EBF4');
        $this->addSql('DROP INDEX IDX_A29B52383B3EBF4 ON sylius_product_variant');
        $this->addSql('ALTER TABLE sylius_product_variant DROP marketPlaceVendor_id');
    }
}
