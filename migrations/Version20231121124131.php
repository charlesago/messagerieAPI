<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121124131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE friend_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE friendship_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE group_conversation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE group_message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE group_message_response_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE private_conversation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE private_message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE profile_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reaction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE refresh_tokens_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE relation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE friend_request (id INT NOT NULL, of_profile_id INT NOT NULL, to_profile_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F284D9425AED32D ON friend_request (of_profile_id)');
        $this->addSql('CREATE INDEX IDX_F284D94EBC9F0C5 ON friend_request (to_profile_id)');
        $this->addSql('COMMENT ON COLUMN friend_request.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE friendship (id INT NOT NULL, friend_a_id INT NOT NULL, friend_b_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7234A45FA1A48FB8 ON friendship (friend_a_id)');
        $this->addSql('CREATE INDEX IDX_7234A45FB3112056 ON friendship (friend_b_id)');
        $this->addSql('COMMENT ON COLUMN friendship.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE group_conversation (id INT NOT NULL, created_by_id INT NOT NULL, admin_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_66C86CD0B03A8386 ON group_conversation (created_by_id)');
        $this->addSql('CREATE INDEX IDX_66C86CD0642B8210 ON group_conversation (admin_id)');
        $this->addSql('CREATE TABLE group_conversation_profile (group_conversation_id INT NOT NULL, profile_id INT NOT NULL, PRIMARY KEY(group_conversation_id, profile_id))');
        $this->addSql('CREATE INDEX IDX_54DD05CBB73F9E4F ON group_conversation_profile (group_conversation_id)');
        $this->addSql('CREATE INDEX IDX_54DD05CBCCFA12B8 ON group_conversation_profile (profile_id)');
        $this->addSql('CREATE TABLE group_message (id INT NOT NULL, author_id INT NOT NULL, conversation_id INT NOT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_30BD6473F675F31B ON group_message (author_id)');
        $this->addSql('CREATE INDEX IDX_30BD64739AC0396 ON group_message (conversation_id)');
        $this->addSql('COMMENT ON COLUMN group_message.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE group_message_reaction (group_message_id INT NOT NULL, reaction_id INT NOT NULL, PRIMARY KEY(group_message_id, reaction_id))');
        $this->addSql('CREATE INDEX IDX_52403A0B84B7729B ON group_message_reaction (group_message_id)');
        $this->addSql('CREATE INDEX IDX_52403A0B813C7171 ON group_message_reaction (reaction_id)');
        $this->addSql('CREATE TABLE group_message_response (id INT NOT NULL, group_message_id INT NOT NULL, author_id INT NOT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C8EC360784B7729B ON group_message_response (group_message_id)');
        $this->addSql('CREATE INDEX IDX_C8EC3607F675F31B ON group_message_response (author_id)');
        $this->addSql('COMMENT ON COLUMN group_message_response.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE message (id INT NOT NULL, author_id INT DEFAULT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6BD307FF675F31B ON message (author_id)');
        $this->addSql('CREATE TABLE private_conversation (id INT NOT NULL, participant_a_id INT NOT NULL, participant_b_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DCF38EEBEF6A4166 ON private_conversation (participant_a_id)');
        $this->addSql('CREATE INDEX IDX_DCF38EEBFDDFEE88 ON private_conversation (participant_b_id)');
        $this->addSql('CREATE TABLE private_message (id INT NOT NULL, author_id INT NOT NULL, private_conversation_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4744FC9BF675F31B ON private_message (author_id)');
        $this->addSql('CREATE INDEX IDX_4744FC9B4242ECCE ON private_message (private_conversation_id)');
        $this->addSql('COMMENT ON COLUMN private_message.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE private_message_reaction (private_message_id INT NOT NULL, reaction_id INT NOT NULL, PRIMARY KEY(private_message_id, reaction_id))');
        $this->addSql('CREATE INDEX IDX_C80AF4CF5EBFB95E ON private_message_reaction (private_message_id)');
        $this->addSql('CREATE INDEX IDX_C80AF4CF813C7171 ON private_message_reaction (reaction_id)');
        $this->addSql('CREATE TABLE profile (id INT NOT NULL, of_user_id INT NOT NULL, username VARCHAR(255) DEFAULT NULL, public BOOLEAN NOT NULL, first_name TEXT DEFAULT NULL, last_name TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0F5A1B2224 ON profile (of_user_id)');
        $this->addSql('CREATE TABLE reaction (id INT NOT NULL, author_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A4D707F7F675F31B ON reaction (author_id)');
        $this->addSql('CREATE TABLE refresh_tokens (id INT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BACE7E1C74F2195 ON refresh_tokens (refresh_token)');
        $this->addSql('CREATE TABLE relation (id INT NOT NULL, relation_as_sender_id INT NOT NULL, relation_as_recipient_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62894749AD6D0CE ON relation (relation_as_sender_id)');
        $this->addSql('CREATE INDEX IDX_628947499AB6B439 ON relation (relation_as_recipient_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, email TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT FK_F284D9425AED32D FOREIGN KEY (of_profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT FK_F284D94EBC9F0C5 FOREIGN KEY (to_profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45FA1A48FB8 FOREIGN KEY (friend_a_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45FB3112056 FOREIGN KEY (friend_b_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_conversation ADD CONSTRAINT FK_66C86CD0B03A8386 FOREIGN KEY (created_by_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_conversation ADD CONSTRAINT FK_66C86CD0642B8210 FOREIGN KEY (admin_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_conversation_profile ADD CONSTRAINT FK_54DD05CBB73F9E4F FOREIGN KEY (group_conversation_id) REFERENCES group_conversation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_conversation_profile ADD CONSTRAINT FK_54DD05CBCCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_message ADD CONSTRAINT FK_30BD6473F675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_message ADD CONSTRAINT FK_30BD64739AC0396 FOREIGN KEY (conversation_id) REFERENCES group_conversation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_message_reaction ADD CONSTRAINT FK_52403A0B84B7729B FOREIGN KEY (group_message_id) REFERENCES group_message (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_message_reaction ADD CONSTRAINT FK_52403A0B813C7171 FOREIGN KEY (reaction_id) REFERENCES reaction (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_message_response ADD CONSTRAINT FK_C8EC360784B7729B FOREIGN KEY (group_message_id) REFERENCES group_message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_message_response ADD CONSTRAINT FK_C8EC3607F675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE private_conversation ADD CONSTRAINT FK_DCF38EEBEF6A4166 FOREIGN KEY (participant_a_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE private_conversation ADD CONSTRAINT FK_DCF38EEBFDDFEE88 FOREIGN KEY (participant_b_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE private_message ADD CONSTRAINT FK_4744FC9BF675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE private_message ADD CONSTRAINT FK_4744FC9B4242ECCE FOREIGN KEY (private_conversation_id) REFERENCES private_conversation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE private_message_reaction ADD CONSTRAINT FK_C80AF4CF5EBFB95E FOREIGN KEY (private_message_id) REFERENCES private_message (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE private_message_reaction ADD CONSTRAINT FK_C80AF4CF813C7171 FOREIGN KEY (reaction_id) REFERENCES reaction (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F5A1B2224 FOREIGN KEY (of_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F7F675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749AD6D0CE FOREIGN KEY (relation_as_sender_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_628947499AB6B439 FOREIGN KEY (relation_as_recipient_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE friend_request_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE friendship_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE group_conversation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE group_message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE group_message_response_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE private_conversation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE private_message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE profile_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reaction_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE refresh_tokens_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE relation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE friend_request DROP CONSTRAINT FK_F284D9425AED32D');
        $this->addSql('ALTER TABLE friend_request DROP CONSTRAINT FK_F284D94EBC9F0C5');
        $this->addSql('ALTER TABLE friendship DROP CONSTRAINT FK_7234A45FA1A48FB8');
        $this->addSql('ALTER TABLE friendship DROP CONSTRAINT FK_7234A45FB3112056');
        $this->addSql('ALTER TABLE group_conversation DROP CONSTRAINT FK_66C86CD0B03A8386');
        $this->addSql('ALTER TABLE group_conversation DROP CONSTRAINT FK_66C86CD0642B8210');
        $this->addSql('ALTER TABLE group_conversation_profile DROP CONSTRAINT FK_54DD05CBB73F9E4F');
        $this->addSql('ALTER TABLE group_conversation_profile DROP CONSTRAINT FK_54DD05CBCCFA12B8');
        $this->addSql('ALTER TABLE group_message DROP CONSTRAINT FK_30BD6473F675F31B');
        $this->addSql('ALTER TABLE group_message DROP CONSTRAINT FK_30BD64739AC0396');
        $this->addSql('ALTER TABLE group_message_reaction DROP CONSTRAINT FK_52403A0B84B7729B');
        $this->addSql('ALTER TABLE group_message_reaction DROP CONSTRAINT FK_52403A0B813C7171');
        $this->addSql('ALTER TABLE group_message_response DROP CONSTRAINT FK_C8EC360784B7729B');
        $this->addSql('ALTER TABLE group_message_response DROP CONSTRAINT FK_C8EC3607F675F31B');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307FF675F31B');
        $this->addSql('ALTER TABLE private_conversation DROP CONSTRAINT FK_DCF38EEBEF6A4166');
        $this->addSql('ALTER TABLE private_conversation DROP CONSTRAINT FK_DCF38EEBFDDFEE88');
        $this->addSql('ALTER TABLE private_message DROP CONSTRAINT FK_4744FC9BF675F31B');
        $this->addSql('ALTER TABLE private_message DROP CONSTRAINT FK_4744FC9B4242ECCE');
        $this->addSql('ALTER TABLE private_message_reaction DROP CONSTRAINT FK_C80AF4CF5EBFB95E');
        $this->addSql('ALTER TABLE private_message_reaction DROP CONSTRAINT FK_C80AF4CF813C7171');
        $this->addSql('ALTER TABLE profile DROP CONSTRAINT FK_8157AA0F5A1B2224');
        $this->addSql('ALTER TABLE reaction DROP CONSTRAINT FK_A4D707F7F675F31B');
        $this->addSql('ALTER TABLE relation DROP CONSTRAINT FK_62894749AD6D0CE');
        $this->addSql('ALTER TABLE relation DROP CONSTRAINT FK_628947499AB6B439');
        $this->addSql('DROP TABLE friend_request');
        $this->addSql('DROP TABLE friendship');
        $this->addSql('DROP TABLE group_conversation');
        $this->addSql('DROP TABLE group_conversation_profile');
        $this->addSql('DROP TABLE group_message');
        $this->addSql('DROP TABLE group_message_reaction');
        $this->addSql('DROP TABLE group_message_response');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE private_conversation');
        $this->addSql('DROP TABLE private_message');
        $this->addSql('DROP TABLE private_message_reaction');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE reaction');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE relation');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
