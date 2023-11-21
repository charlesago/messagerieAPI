<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231110105641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE friend_request DROP CONSTRAINT fk_f284d94987e4c75');
        $this->addSql('DROP INDEX idx_f284d94987e4c75');
        $this->addSql('ALTER TABLE friend_request ALTER recipient_profile_id SET NOT NULL');
        $this->addSql('ALTER TABLE friend_request RENAME COLUMN sender_profile_id TO senderprofile_id');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT FK_F284D94DB6F5753 FOREIGN KEY (senderprofile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F284D94DB6F5753 ON friend_request (senderprofile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE friend_request DROP CONSTRAINT FK_F284D94DB6F5753');
        $this->addSql('DROP INDEX IDX_F284D94DB6F5753');
        $this->addSql('ALTER TABLE friend_request ALTER recipient_profile_id DROP NOT NULL');
        $this->addSql('ALTER TABLE friend_request RENAME COLUMN senderprofile_id TO sender_profile_id');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT fk_f284d94987e4c75 FOREIGN KEY (sender_profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_f284d94987e4c75 ON friend_request (sender_profile_id)');
    }
}
