<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630125827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE MarketPlaceProduct (id INT AUTO_INCREMENT NOT NULL, Product_id INT DEFAULT NULL, MarketPlaceVendor_id INT DEFAULT NULL, INDEX IDX_48AFAEF6AD9658A (Product_id), INDEX IDX_48AFAEF6994FBBFF (MarketPlaceVendor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marketplaceproduct_productvariant (marketplaceproduct_id INT NOT NULL, productvariant_id INT NOT NULL, INDEX IDX_742C7CFF1B5FD92 (marketplaceproduct_id), INDEX IDX_742C7CF1855BE3F (productvariant_id), PRIMARY KEY(marketplaceproduct_id, productvariant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE MarketPlaceProduct ADD CONSTRAINT FK_48AFAEF6AD9658A FOREIGN KEY (Product_id) REFERENCES sylius_product (id)');
        $this->addSql('ALTER TABLE MarketPlaceProduct ADD CONSTRAINT FK_48AFAEF6994FBBFF FOREIGN KEY (MarketPlaceVendor_id) REFERENCES MarketPlaceVendor (id)');
        $this->addSql('ALTER TABLE marketplaceproduct_productvariant ADD CONSTRAINT FK_742C7CFF1B5FD92 FOREIGN KEY (marketplaceproduct_id) REFERENCES MarketPlaceProduct (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marketplaceproduct_productvariant ADD CONSTRAINT FK_742C7CF1855BE3F FOREIGN KEY (productvariant_id) REFERENCES sylius_product_variant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE MarketPlaceBankAccount ADD CONSTRAINT FK_E7EABAB6994FBBFF FOREIGN KEY (MarketPlaceVendor_id) REFERENCES MarketPlaceVendor (id)');
        $this->addSql('ALTER TABLE MarketPlaceStore ADD CONSTRAINT FK_29AA55A383B3EBF4 FOREIGN KEY (marketPlaceVendor_id) REFERENCES MarketPlaceVendor (id)');
        $this->addSql('ALTER TABLE sylius_product DROP FOREIGN KEY FK_677B9B744ED7932C');
        $this->addSql('DROP INDEX FK_677B9B744ED7932C ON sylius_product');
        $this->addSql('ALTER TABLE sylius_product DROP marketplaceVendor_id');
        $this->addSql('DROP INDEX IDX_A29B52383B3EBF4 ON sylius_product_variant');
        $this->addSql('ALTER TABLE sylius_product_variant DROP marketPlaceVendor_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marketplaceproduct_productvariant DROP FOREIGN KEY FK_742C7CFF1B5FD92');
        $this->addSql('DROP TABLE MarketPlaceProduct');
        $this->addSql('DROP TABLE marketplaceproduct_productvariant');
        $this->addSql('ALTER TABLE MarketPlaceBankAccount DROP FOREIGN KEY FK_E7EABAB6994FBBFF');
        $this->addSql('ALTER TABLE MarketPlaceStore DROP FOREIGN KEY FK_29AA55A383B3EBF4');
        $this->addSql('ALTER TABLE sylius_product ADD marketplaceVendor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_product ADD CONSTRAINT FK_677B9B744ED7932C FOREIGN KEY (marketplaceVendor_id) REFERENCES MarketPlaceVendor (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX FK_677B9B744ED7932C ON sylius_product (marketplaceVendor_id)');
        $this->addSql('ALTER TABLE sylius_product_variant ADD marketPlaceVendor_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_A29B52383B3EBF4 ON sylius_product_variant (marketPlaceVendor_id)');
    }
}
