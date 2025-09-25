<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250925154840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE announcement (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_4DB9D91CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE changelog (id INT AUTO_INCREMENT NOT NULL, version VARCHAR(20) NOT NULL, date DATETIME NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C8422601989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devblog (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, date DATETIME NOT NULL, image VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2D6FB251989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_section (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, type VARCHAR(50) NOT NULL, is_visible TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_DCBF379E989D9B62 (slug), INDEX idx_forumsection_slug (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, topic_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_edited TINYINT(1) NOT NULL, INDEX IDX_5A8A6C8DA76ED395 (user_id), INDEX IDX_5A8A6C8D1F55203D (topic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presentation (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, background VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_389B7835E237E06 (name), UNIQUE INDEX UNIQ_389B783989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topic (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, section_id INT DEFAULT NULL, title VARCHAR(150) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_pinned TINYINT(1) NOT NULL, is_quarantined TINYINT(1) NOT NULL, deleted_at DATETIME DEFAULT NULL, view_count INT NOT NULL, last_activity DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_9D40DE1B2B36786B (title), INDEX IDX_9D40DE1BF675F31B (author_id), INDEX IDX_9D40DE1BD823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topic_tag (topic_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_302AC6211F55203D (topic_id), INDEX IDX_302AC621BAD26311 (tag_id), PRIMARY KEY(topic_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(50) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, last_login DATETIME DEFAULT NULL, last_password_request_at DATETIME DEFAULT NULL, ban_until DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', reset_token VARCHAR(64) DEFAULT NULL, token_expires_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_topic (user_id INT NOT NULL, topic_id INT NOT NULL, INDEX IDX_7F822543A76ED395 (user_id), INDEX IDX_7F8225431F55203D (topic_id), PRIMARY KEY(user_id, topic_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91CF675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D1F55203D FOREIGN KEY (topic_id) REFERENCES topic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1BF675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1BD823E37A FOREIGN KEY (section_id) REFERENCES forum_section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE topic_tag ADD CONSTRAINT FK_302AC6211F55203D FOREIGN KEY (topic_id) REFERENCES topic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE topic_tag ADD CONSTRAINT FK_302AC621BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_topic ADD CONSTRAINT FK_7F822543A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_topic ADD CONSTRAINT FK_7F8225431F55203D FOREIGN KEY (topic_id) REFERENCES topic (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91CF675F31B');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D1F55203D');
        $this->addSql('ALTER TABLE topic DROP FOREIGN KEY FK_9D40DE1BF675F31B');
        $this->addSql('ALTER TABLE topic DROP FOREIGN KEY FK_9D40DE1BD823E37A');
        $this->addSql('ALTER TABLE topic_tag DROP FOREIGN KEY FK_302AC6211F55203D');
        $this->addSql('ALTER TABLE topic_tag DROP FOREIGN KEY FK_302AC621BAD26311');
        $this->addSql('ALTER TABLE user_topic DROP FOREIGN KEY FK_7F822543A76ED395');
        $this->addSql('ALTER TABLE user_topic DROP FOREIGN KEY FK_7F8225431F55203D');
        $this->addSql('DROP TABLE announcement');
        $this->addSql('DROP TABLE changelog');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE devblog');
        $this->addSql('DROP TABLE forum_section');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE presentation');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE topic');
        $this->addSql('DROP TABLE topic_tag');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_topic');
    }
}
