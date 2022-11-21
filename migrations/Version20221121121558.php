<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221121121558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hackathon CHANGE salle salle LONGTEXT NOT NULL, CHANGE rue rue LONGTEXT NOT NULL, CHANGE ville ville LONGTEXT NOT NULL, CHANGE theme theme LONGTEXT NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE nb_places nb_places NUMERIC(4, 0) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hackathon CHANGE salle salle VARCHAR(30) NOT NULL, CHANGE rue rue VARCHAR(50) NOT NULL, CHANGE ville ville VARCHAR(25) NOT NULL, CHANGE theme theme VARCHAR(60) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE nb_places nb_places INT NOT NULL');
    }
}
