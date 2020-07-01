<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701101352 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advert (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, type_id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(100) NOT NULL, is_booked TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_54F1F40B44F5D008 (brand_id), INDEX IDX_54F1F40BC54C8C93 (type_id), INDEX IDX_54F1F40BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advert_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40B44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40BC54C8C93 FOREIGN KEY (type_id) REFERENCES advert_type (id)');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40BC54C8C93');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40B44F5D008');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40BA76ED395');
        $this->addSql('DROP TABLE advert');
        $this->addSql('DROP TABLE advert_type');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE user');
    }
}
