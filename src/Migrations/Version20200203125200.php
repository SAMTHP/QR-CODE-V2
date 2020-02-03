<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200203125200 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // $this->addSql('CREATE TABLE discount_tag (discount_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_E519AE844C7C611F (discount_id), INDEX IDX_E519AE84BAD26311 (tag_id), PRIMARY KEY(discount_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE discount_tag ADD CONSTRAINT FK_E519AE844C7C611F FOREIGN KEY (discount_id) REFERENCES discount (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discount_tag ADD CONSTRAINT FK_E519AE84BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE tag_discount');
        $this->addSql('ALTER TABLE discount CHANGE max_flash max_flash INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tag_discount (tag_id INT NOT NULL, discount_id INT NOT NULL, INDEX IDX_D7D1CFD54C7C611F (discount_id), INDEX IDX_D7D1CFD5BAD26311 (tag_id), PRIMARY KEY(tag_id, discount_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tag_discount ADD CONSTRAINT FK_D7D1CFD54C7C611F FOREIGN KEY (discount_id) REFERENCES discount (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_discount ADD CONSTRAINT FK_D7D1CFD5BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE discount_tag');
        $this->addSql('ALTER TABLE discount CHANGE max_flash max_flash INT DEFAULT NULL');
    }
}
