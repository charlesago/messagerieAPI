<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108131921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE friend_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE friend_request (id INT NOT NULL, sender_profile_id INT DEFAULT NULL, recipient_profile_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F284D94987E4C75 ON friend_request (sender_profile_id)');
        $this->addSql('CREATE INDEX IDX_F284D94B4FA58C6 ON friend_request (recipient_profile_id)');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT FK_F284D94987E4C75 FOREIGN KEY (sender_profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT FK_F284D94B4FA58C6 FOREIGN KEY (recipient_profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE friend_request_id_seq CASCADE');
        $this->addSql('ALTER TABLE friend_request DROP CONSTRAINT FK_F284D94987E4C75');
        $this->addSql('ALTER TABLE friend_request DROP CONSTRAINT FK_F284D94B4FA58C6');
        $this->addSql('DROP TABLE friend_request');
    }
}
