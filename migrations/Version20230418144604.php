<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230418144604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cartProduct (cart_id INT NOT NULL, cartProduct_id INT NOT NULL, INDEX IDX_EB40B8ED1AD5CDBF (cart_id), INDEX IDX_EB40B8ED9DBBE308 (cartProduct_id), PRIMARY KEY(cart_id, cartProduct_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cartProduct ADD CONSTRAINT FK_EB40B8ED1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cartProduct ADD CONSTRAINT FK_EB40B8ED9DBBE308 FOREIGN KEY (cartProduct_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74584665A');
        $this->addSql('DROP INDEX IDX_BA388B74584665A ON cart');
        $this->addSql('ALTER TABLE cart DROP product_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cartProduct DROP FOREIGN KEY FK_EB40B8ED1AD5CDBF');
        $this->addSql('ALTER TABLE cartProduct DROP FOREIGN KEY FK_EB40B8ED9DBBE308');
        $this->addSql('DROP TABLE cartProduct');
        $this->addSql('ALTER TABLE cart ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_BA388B74584665A ON cart (product_id)');
    }
}
