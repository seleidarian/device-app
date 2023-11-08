<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230912174550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A252FC55A77');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E4F7A72E4');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E896DBBDE');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E1F55203D');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE topic');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE question');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, answered_by_id INT NOT NULL, answer LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, votes INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_DADD4A251E27F6BF (question_id), INDEX IDX_DADD4A252FC55A77 (answered_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE topic (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, enabled TINYINT(1) NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, avatar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, asked_by_id INT NOT NULL, topic_id INT NOT NULL, updated_by_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, question LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, votes INT NOT NULL, is_approved TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_B6F7494E896DBBDE (updated_by_id), UNIQUE INDEX UNIQ_B6F7494E989D9B62 (slug), INDEX IDX_B6F7494E4F7A72E4 (asked_by_id), INDEX IDX_B6F7494E1F55203D (topic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A252FC55A77 FOREIGN KEY (answered_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E4F7A72E4 FOREIGN KEY (asked_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E1F55203D FOREIGN KEY (topic_id) REFERENCES topic (id)');
        $this->addSql('DROP TABLE users');
    }
}
