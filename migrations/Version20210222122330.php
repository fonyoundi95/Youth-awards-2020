<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210222122330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CCBBCF7F5');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CCBBCF7F5 FOREIGN KEY (autors_id) REFERENCES autor (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CCBBCF7F5');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CCBBCF7F5 FOREIGN KEY (autors_id) REFERENCES award (id)');
    }
}
