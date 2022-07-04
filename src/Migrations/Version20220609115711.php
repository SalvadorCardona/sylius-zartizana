<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609115711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_product_variant DROP FOREIGN KEY FK_A29B52383B3EBF4');
        $this->addSql('ALTER TABLE MarketPlaceBankAccount DROP FOREIGN KEY FK_E7EABAB6994FBBFF');
        $this->addSql('ALTER TABLE MarketPlaceStore DROP FOREIGN KEY FK_29AA55A383B3EBF4');
        $this->addSql('ALTER TABLE sylius_product DROP FOREIGN KEY FK_677B9B744ED7932C');

        $this->addSql('ALTER TABLE MarketPlaceBankAccount CHANGE MarketPlaceVendor_id MarketPlaceVendor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE MarketPlaceStore CHANGE marketPlaceVendor_id marketPlaceVendor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE MarketPlaceVendor CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE sylius_product CHANGE marketplaceVendor_id marketplaceVendor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_product ADD CONSTRAINT FK_677B9B744ED7932C FOREIGN KEY (marketplaceVendor_id) REFERENCES MarketPlaceVendor (id)');
        $this->addSql('ALTER TABLE sylius_product_variant CHANGE marketPlaceVendor_id marketPlaceVendor_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sylius_product_variant DROP FOREIGN KEY FK_A29B52383B3EBF4');
        $this->addSql('ALTER TABLE MarketPlaceBankAccount ADD CONSTRAINT FK_E7EABAB6994FBBFF FOREIGN KEY (MarketPlaceVendor_id) REFERENCES MarketPlaceVendor (id)');
        $this->addSql('ALTER TABLE MarketPlaceStore ADD CONSTRAINT FK_29AA55A383B3EBF4 FOREIGN KEY (marketPlaceVendor_id) REFERENCES MarketPlaceVendor (id)');

        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE MarketPlaceBankAccount CHANGE MarketPlaceVendor_id MarketPlaceVendor_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE MarketPlaceStore CHANGE marketPlaceVendor_id marketPlaceVendor_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE MarketPlaceVendor CHANGE id id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE sylius_product DROP FOREIGN KEY FK_677B9B744ED7932C');
        $this->addSql('ALTER TABLE sylius_product CHANGE marketplaceVendor_id marketplaceVendor_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE sylius_product_variant CHANGE marketPlaceVendor_id marketPlaceVendor_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
    }
}
