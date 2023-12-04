<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231112174046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE TABLE target (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE TABLE type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('ALTER TABLE article ADD COLUMN duration INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD COLUMN bandwidth INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD COLUMN width INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD COLUMN signal BOOLEAN DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article_type');
        $this->addSql('DROP TABLE target');
        $this->addSql('DROP TABLE type');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, frequency CLOB DEFAULT NULL --(DC2Type:json)
        , photo VARCHAR(255) DEFAULT NULL, photo_spectr VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, aim SMALLINT DEFAULT NULL, targets CLOB DEFAULT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO article (id, name, type, frequency, photo, photo_spectr, description, aim, targets) SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
    }
}
