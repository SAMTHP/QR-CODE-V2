<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200213112223 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE demo2 (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demo2_demo (demo2_id INT NOT NULL, demo_id INT NOT NULL, INDEX IDX_1F957FF18427C27A (demo2_id), INDEX IDX_1F957FF1214B61EA (demo_id), PRIMARY KEY(demo2_id, demo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demo (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demo2_demo ADD CONSTRAINT FK_1F957FF18427C27A FOREIGN KEY (demo2_id) REFERENCES demo2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demo2_demo ADD CONSTRAINT FK_1F957FF1214B61EA FOREIGN KEY (demo_id) REFERENCES demo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discount CHANGE max_flash max_flash INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE demo2_demo DROP FOREIGN KEY FK_1F957FF18427C27A');
        $this->addSql('ALTER TABLE demo2_demo DROP FOREIGN KEY FK_1F957FF1214B61EA');
        $this->addSql('DROP TABLE demo2');
        $this->addSql('DROP TABLE demo2_demo');
        $this->addSql('DROP TABLE demo');
        $this->addSql('ALTER TABLE discount CHANGE max_flash max_flash INT DEFAULT NULL');
    }
}
