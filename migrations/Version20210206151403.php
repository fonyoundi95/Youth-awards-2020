<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210206151403 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD awards_id INT DEFAULT NULL, ADD autors_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CEC973086 FOREIGN KEY (awards_id) REFERENCES award (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CCBBCF7F5 FOREIGN KEY (autors_id) REFERENCES award (id)');
        $this->addSql('CREATE INDEX IDX_9474526CEC973086 ON comment (awards_id)');
        $this->addSql('CREATE INDEX IDX_9474526CCBBCF7F5 ON comment (autors_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CEC973086');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CCBBCF7F5');
        $this->addSql('DROP INDEX IDX_9474526CEC973086 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CCBBCF7F5 ON comment');
        $this->addSql('ALTER TABLE comment DROP awards_id, DROP autors_id');
    }
}
