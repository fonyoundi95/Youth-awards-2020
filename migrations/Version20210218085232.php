<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218085232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_autor (role_id INT NOT NULL, autor_id INT NOT NULL, INDEX IDX_C6DBB695D60322AC (role_id), INDEX IDX_C6DBB69514D45BBE (autor_id), PRIMARY KEY(role_id, autor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role_autor ADD CONSTRAINT FK_C6DBB695D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_autor ADD CONSTRAINT FK_C6DBB69514D45BBE FOREIGN KEY (autor_id) REFERENCES autor (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_autor DROP FOREIGN KEY FK_C6DBB695D60322AC');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_autor');
    }
}
