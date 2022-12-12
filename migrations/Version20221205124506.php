<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205124506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Evenement (id INT AUTO_INCREMENT NOT NULL, hackathon_id INT NOT NULL, id_evenement INT NOT NULL, libelle VARCHAR(50) NOT NULL, date DATE NOT NULL, heure TIME NOT NULL, duree TIME NOT NULL, salle VARCHAR(50) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_89D7EABD996D90CF (hackathon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conference (id INT NOT NULL, theme VARCHAR(255) NOT NULL, intervenent VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE initiation (id INT NOT NULL, nb_participant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, hackathon_id INT NOT NULL, id_insc INT NOT NULL, date_insc DATE NOT NULL, INDEX IDX_5E90F6D6A76ED395 (user_id), INDEX IDX_5E90F6D6996D90CF (hackathon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscrit (id INT AUTO_INCREMENT NOT NULL, id_inscription INT NOT NULL, nom_insc VARCHAR(30) NOT NULL, prenom_insc VARCHAR(30) NOT NULL, mail VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscrit_initiation (inscrit_id INT NOT NULL, initiation_id INT NOT NULL, INDEX IDX_AFDF6A366DCD4FEE (inscrit_id), INDEX IDX_AFDF6A36118CE583 (initiation_id), PRIMARY KEY(inscrit_id, initiation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, tel VARCHAR(10) NOT NULL, mail VARCHAR(50) NOT NULL, date_naissance DATE NOT NULL, lien_portfolio VARCHAR(255) NOT NULL, login VARCHAR(30) NOT NULL, mdp VARCHAR(255) NOT NULL, sel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Evenement ADD CONSTRAINT FK_89D7EABD996D90CF FOREIGN KEY (hackathon_id) REFERENCES hackathon (id)');
        $this->addSql('ALTER TABLE conference ADD CONSTRAINT FK_911533C8BF396750 FOREIGN KEY (id) REFERENCES Evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE initiation ADD CONSTRAINT FK_EDC7AE6EBF396750 FOREIGN KEY (id) REFERENCES Evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6996D90CF FOREIGN KEY (hackathon_id) REFERENCES hackathon (id)');
        $this->addSql('ALTER TABLE inscrit_initiation ADD CONSTRAINT FK_AFDF6A366DCD4FEE FOREIGN KEY (inscrit_id) REFERENCES inscrit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscrit_initiation ADD CONSTRAINT FK_AFDF6A36118CE583 FOREIGN KEY (initiation_id) REFERENCES initiation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Evenement DROP FOREIGN KEY FK_89D7EABD996D90CF');
        $this->addSql('ALTER TABLE conference DROP FOREIGN KEY FK_911533C8BF396750');
        $this->addSql('ALTER TABLE initiation DROP FOREIGN KEY FK_EDC7AE6EBF396750');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A76ED395');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6996D90CF');
        $this->addSql('ALTER TABLE inscrit_initiation DROP FOREIGN KEY FK_AFDF6A366DCD4FEE');
        $this->addSql('ALTER TABLE inscrit_initiation DROP FOREIGN KEY FK_AFDF6A36118CE583');
        $this->addSql('DROP TABLE Evenement');
        $this->addSql('DROP TABLE conference');
        $this->addSql('DROP TABLE initiation');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE inscrit');
        $this->addSql('DROP TABLE inscrit_initiation');
        $this->addSql('DROP TABLE user');
    }
}
