<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701111725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advert ADD booking_user_id INT DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40BFDD096B5 FOREIGN KEY (booking_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_54F1F40BFDD096B5 ON advert (booking_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40BFDD096B5');
        $this->addSql('DROP INDEX IDX_54F1F40BFDD096B5 ON advert');
        $this->addSql('ALTER TABLE advert DROP booking_user_id, DROP description');
    }
}
