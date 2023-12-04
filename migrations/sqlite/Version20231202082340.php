<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231202082340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_by_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, type SMALLINT DEFAULT NULL, frequency CLOB DEFAULT NULL --(DC2Type:json)
        , photo VARCHAR(255) DEFAULT NULL, photo_spectr VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, aim SMALLINT DEFAULT NULL, targets CLOB DEFAULT NULL --(DC2Type:simple_array)
        , duration INTEGER DEFAULT NULL, bandwidth INTEGER DEFAULT NULL, width INTEGER DEFAULT NULL, signal BOOLEAN DEFAULT NULL, bpla_signal_kind SMALLINT DEFAULT NULL, bpla_la_type SMALLINT DEFAULT NULL, bpla_engine SMALLINT DEFAULT NULL, bpla_signal_type SMALLINT DEFAULT NULL, bpla_mode SMALLINT DEFAULT NULL, work_mode SMALLINT DEFAULT NULL, work_type SMALLINT DEFAULT NULL, barrier_type CLOB DEFAULT NULL --(DC2Type:simple_array)
        , created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL, CONSTRAINT FK_23A0E66B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article (id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type) SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E66B03A8386 ON article (created_by_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__images AS SELECT id, article_id_id, name, created_at, updated_at FROM images');
        $this->addSql('DROP TABLE images');
        $this->addSql('CREATE TABLE images (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_E01FBE6A8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO images (id, article_id_id, name, created_at, updated_at) SELECT id, article_id_id, name, created_at, updated_at FROM __temp__images');
        $this->addSql('DROP TABLE __temp__images');
        $this->addSql('CREATE INDEX IDX_E01FBE6A8F3EC46 ON images (article_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type SMALLINT DEFAULT NULL, frequency CLOB DEFAULT NULL --(DC2Type:json)
        , photo VARCHAR(255) DEFAULT NULL, photo_spectr VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, aim SMALLINT DEFAULT NULL, targets CLOB DEFAULT NULL --(DC2Type:simple_array)
        , duration INTEGER DEFAULT NULL, bandwidth INTEGER DEFAULT NULL, width INTEGER DEFAULT NULL, signal BOOLEAN DEFAULT NULL, bpla_signal_kind SMALLINT DEFAULT NULL, bpla_la_type SMALLINT DEFAULT NULL, bpla_engine SMALLINT DEFAULT NULL, bpla_signal_type SMALLINT DEFAULT NULL, bpla_mode SMALLINT DEFAULT NULL, work_mode SMALLINT DEFAULT NULL, work_type SMALLINT DEFAULT NULL, barrier_type CLOB DEFAULT NULL --(DC2Type:simple_array)
        )');
        $this->addSql('INSERT INTO article (id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type) SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE TEMPORARY TABLE __temp__images AS SELECT id, article_id_id, name, created_at, updated_at FROM images');
        $this->addSql('DROP TABLE images');
        $this->addSql('CREATE TABLE images (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_E01FBE6A8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO images (id, article_id_id, name, created_at, updated_at) SELECT id, article_id_id, name, created_at, updated_at FROM __temp__images');
        $this->addSql('DROP TABLE __temp__images');
        $this->addSql('CREATE INDEX IDX_E01FBE6A8F3EC46 ON images (article_id_id)');
    }
}
