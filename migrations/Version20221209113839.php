<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221209113839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Evenement DROP id_evenement');
        $this->addSql('ALTER TABLE inscription DROP id_insc');
        $this->addSql('ALTER TABLE inscrit DROP id_inscription');
        $this->addSql('ALTER TABLE user DROP id_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD id_user INT NOT NULL');
        $this->addSql('ALTER TABLE inscrit ADD id_inscription INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD id_insc INT NOT NULL');
        $this->addSql('ALTER TABLE Evenement ADD id_evenement INT NOT NULL');
    }
}
