<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121142312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE images (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_E01FBE6A8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A8F3EC46 ON images (article_id_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type SMALLINT DEFAULT NULL, frequency CLOB DEFAULT NULL --(DC2Type:json)
        , photo CLOB DEFAULT NULL --(DC2Type:simple_array)
        , photo_spectr VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, aim SMALLINT DEFAULT NULL, targets CLOB DEFAULT NULL --(DC2Type:simple_array)
        , duration INTEGER DEFAULT NULL, bandwidth INTEGER DEFAULT NULL, width INTEGER DEFAULT NULL, signal BOOLEAN DEFAULT NULL, bpla_signal_kind SMALLINT DEFAULT NULL, bpla_la_type SMALLINT DEFAULT NULL, bpla_engine SMALLINT DEFAULT NULL, bpla_signal_type SMALLINT DEFAULT NULL, bpla_mode SMALLINT DEFAULT NULL, work_mode SMALLINT DEFAULT NULL, work_type SMALLINT DEFAULT NULL, barrier_type CLOB DEFAULT NULL --(DC2Type:simple_array)
        )');
        $this->addSql('INSERT INTO article (id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type) SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE images');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type SMALLINT DEFAULT NULL, frequency CLOB DEFAULT NULL --(DC2Type:json)
        , photo VARCHAR(255) DEFAULT NULL, photo_spectr VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, aim SMALLINT DEFAULT NULL, targets CLOB DEFAULT NULL --(DC2Type:simple_array)
        , duration INTEGER DEFAULT NULL, bandwidth INTEGER DEFAULT NULL, width INTEGER DEFAULT NULL, signal BOOLEAN DEFAULT NULL, bpla_signal_kind CLOB DEFAULT NULL --(DC2Type:simple_array)
        , bpla_la_type CLOB DEFAULT NULL --(DC2Type:simple_array)
        , bpla_engine CLOB DEFAULT NULL --(DC2Type:simple_array)
        , bpla_signal_type SMALLINT DEFAULT NULL, bpla_mode SMALLINT DEFAULT NULL, work_mode SMALLINT DEFAULT NULL, work_type SMALLINT DEFAULT NULL, barrier_type CLOB DEFAULT NULL --(DC2Type:simple_array)
        )');
        $this->addSql('INSERT INTO article (id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type) SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
    }
}
