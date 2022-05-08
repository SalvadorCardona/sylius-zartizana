<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220508160511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE MarketPlaceVendor (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id INT DEFAULT NULL, marketPlaceVendorAddress_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_744AD836A76ED395 (user_id), UNIQUE INDEX UNIQ_744AD8366C4BC14C (marketPlaceVendorAddress_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE MarketPlaceVendorAddress (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE MarketPlaceVendor ADD CONSTRAINT FK_744AD836A76ED395 FOREIGN KEY (user_id) REFERENCES sylius_shop_user (id)');
        $this->addSql('ALTER TABLE MarketPlaceVendor ADD CONSTRAINT FK_744AD8366C4BC14C FOREIGN KEY (marketPlaceVendorAddress_id) REFERENCES MarketPlaceVendorAddress (id)');
        $this->addSql('ALTER TABLE sylius_product ADD marketplaceVendor_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE sylius_product ADD CONSTRAINT FK_677B9B744ED7932C FOREIGN KEY (marketplaceVendor_id) REFERENCES MarketPlaceVendor (id)');
        $this->addSql('CREATE INDEX IDX_677B9B744ED7932C ON sylius_product (marketplaceVendor_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE queue_name queue_name VARCHAR(190) NOT NULL');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_product DROP FOREIGN KEY FK_677B9B744ED7932C');
        $this->addSql('ALTER TABLE MarketPlaceVendor DROP FOREIGN KEY FK_744AD8366C4BC14C');
        $this->addSql('DROP TABLE MarketPlaceVendor');
        $this->addSql('DROP TABLE MarketPlaceVendorAddress');
        $this->addSql('DROP INDEX IDX_75EA56E0FB7336F0 ON messenger_messages');
        $this->addSql('DROP INDEX IDX_75EA56E0E3BD61CE ON messenger_messages');
        $this->addSql('ALTER TABLE messenger_messages CHANGE queue_name queue_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_677B9B744ED7932C ON sylius_product');
        $this->addSql('ALTER TABLE sylius_product DROP marketplaceVendor_id');
    }
}
