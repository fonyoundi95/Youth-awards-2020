<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210130115949 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE award ADD cathegori_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE award ADD CONSTRAINT FK_8A5B2EE7DEDE410E FOREIGN KEY (cathegori_id) REFERENCES cathegori (id)');
        $this->addSql('CREATE INDEX IDX_8A5B2EE7DEDE410E ON award (cathegori_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE award DROP FOREIGN KEY FK_8A5B2EE7DEDE410E');
        $this->addSql('DROP INDEX IDX_8A5B2EE7DEDE410E ON award');
        $this->addSql('ALTER TABLE award DROP cathegori_id');
    }
}
