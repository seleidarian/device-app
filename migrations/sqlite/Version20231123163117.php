<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123163117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images ADD COLUMN created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE images ADD COLUMN updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__images AS SELECT id, article_id_id, name FROM images');
        $this->addSql('DROP TABLE images');
        $this->addSql('CREATE TABLE images (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_E01FBE6A8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO images (id, article_id_id, name) SELECT id, article_id_id, name FROM __temp__images');
        $this->addSql('DROP TABLE __temp__images');
        $this->addSql('CREATE INDEX IDX_E01FBE6A8F3EC46 ON images (article_id_id)');
    }
}
