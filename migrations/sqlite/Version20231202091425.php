<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231202091425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type, created_at, updated_at FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type SMALLINT DEFAULT NULL, frequency CLOB DEFAULT NULL --(DC2Type:json)
        , photo VARCHAR(255) DEFAULT NULL, photo_spectr VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, aim SMALLINT DEFAULT NULL, targets CLOB DEFAULT NULL --(DC2Type:simple_array)
        , duration INTEGER DEFAULT NULL, bandwidth INTEGER DEFAULT NULL, width INTEGER DEFAULT NULL, signal BOOLEAN DEFAULT NULL, bpla_signal_kind SMALLINT DEFAULT NULL, bpla_la_type SMALLINT DEFAULT NULL, bpla_engine SMALLINT DEFAULT NULL, bpla_signal_type SMALLINT DEFAULT NULL, bpla_mode SMALLINT DEFAULT NULL, work_mode SMALLINT DEFAULT NULL, work_type SMALLINT DEFAULT NULL, barrier_type CLOB DEFAULT NULL --(DC2Type:simple_array)
        , created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO article (id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type, created_at, updated_at) SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type, created_at, updated_at FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type, created_at, updated_at FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_by_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, type SMALLINT DEFAULT NULL, frequency CLOB DEFAULT NULL --(DC2Type:json)
        , photo VARCHAR(255) DEFAULT NULL, photo_spectr VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, aim SMALLINT DEFAULT NULL, targets CLOB DEFAULT NULL --(DC2Type:simple_array)
        , duration INTEGER DEFAULT NULL, bandwidth INTEGER DEFAULT NULL, width INTEGER DEFAULT NULL, signal BOOLEAN DEFAULT NULL, bpla_signal_kind SMALLINT DEFAULT NULL, bpla_la_type SMALLINT DEFAULT NULL, bpla_engine SMALLINT DEFAULT NULL, bpla_signal_type SMALLINT DEFAULT NULL, bpla_mode SMALLINT DEFAULT NULL, work_mode SMALLINT DEFAULT NULL, work_type SMALLINT DEFAULT NULL, barrier_type CLOB DEFAULT NULL --(DC2Type:simple_array)
        , created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL, CONSTRAINT FK_23A0E66B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article (id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type, created_at, updated_at) SELECT id, name, type, frequency, photo, photo_spectr, description, aim, targets, duration, bandwidth, width, signal, bpla_signal_kind, bpla_la_type, bpla_engine, bpla_signal_type, bpla_mode, work_mode, work_type, barrier_type, created_at, updated_at FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E66B03A8386 ON article (created_by_id)');
    }
}
