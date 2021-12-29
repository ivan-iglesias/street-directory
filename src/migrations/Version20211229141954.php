<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229141954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE portal (id INT AUTO_INCREMENT NOT NULL, street_id INT NOT NULL, number INT NOT NULL, bis VARCHAR(1) DEFAULT NULL, INDEX IDX_BAE93F087CF8EB (street_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE street (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, thoroughfare_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F0EED3D88BAC62AF (city_id), INDEX IDX_F0EED3D8D0E14BEA (thoroughfare_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thoroughfare (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(2) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE portal ADD CONSTRAINT FK_BAE93F087CF8EB FOREIGN KEY (street_id) REFERENCES street (id)');
        $this->addSql('ALTER TABLE street ADD CONSTRAINT FK_F0EED3D88BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE street ADD CONSTRAINT FK_F0EED3D8D0E14BEA FOREIGN KEY (thoroughfare_id) REFERENCES thoroughfare (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE portal DROP FOREIGN KEY FK_BAE93F087CF8EB');
        $this->addSql('ALTER TABLE street DROP FOREIGN KEY FK_F0EED3D8D0E14BEA');
        $this->addSql('DROP TABLE portal');
        $this->addSql('DROP TABLE street');
        $this->addSql('DROP TABLE thoroughfare');
    }
}
