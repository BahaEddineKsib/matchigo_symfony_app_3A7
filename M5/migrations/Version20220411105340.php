<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411105340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE facture (idFacture INT AUTO_INCREMENT NOT NULL, prix Total DOUBLE PRECISION NOT NULL, date DATE NOT NULL, idClient INT DEFAULT NULL, INDEX id_client (idClient), PRIMARY KEY(idFacture)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `match` (ref_match INT AUTO_INCREMENT NOT NULL, id_client DATE NOT NULL, date_match DATE NOT NULL, PRIMARY KEY(ref_match)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, note DOUBLE PRECISION NOT NULL, address VARCHAR(200) NOT NULL, description VARCHAR(200) NOT NULL, type VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan (id INT AUTO_INCREMENT NOT NULL, prix DOUBLE PRECISION NOT NULL, titre VARCHAR(300) NOT NULL, description VARCHAR(5000) NOT NULL, nmbrPlacesMax INT NOT NULL, nmbrPlacesReste INT NOT NULL, dateDebut DATE NOT NULL, dateFin DATE NOT NULL, note DOUBLE PRECISION NOT NULL, pointDepart INT DEFAULT NULL, idGuide INT DEFAULT NULL, INDEX IDX_DD5A5B7D359FD231 (pointDepart), INDEX idguide_fk (idGuide), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan_image (id INT AUTO_INCREMENT NOT NULL, idPlan INT NOT NULL, path VARCHAR(400) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan_place (ref INT AUTO_INCREMENT NOT NULL, idplace INT DEFAULT NULL, idplan INT DEFAULT NULL, INDEX idplan (idplan), INDEX idplace (idplace), PRIMARY KEY(ref)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rdv (ref_rdv INT AUTO_INCREMENT NOT NULL, idPlan INT NOT NULL, date_rdv DATE NOT NULL, reduction DOUBLE PRECISION NOT NULL, PRIMARY KEY(ref_rdv)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, date DATE NOT NULL, rec_reference VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, INDEX user_id (user_id), UNIQUE INDEX rec_reference (rec_reference), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, rec_reference VARCHAR(255) DEFAULT NULL, rec_id INT DEFAULT NULL, datecreation DATE NOT NULL, message VARCHAR(255) NOT NULL, INDEX recid (rec_id), INDEX rec_reference (rec_reference), INDEX user_id (rec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (numReservation INT AUTO_INCREMENT NOT NULL, idClient INT NOT NULL, nbrPlace INT NOT NULL, idPlan INT DEFAULT NULL, INDEX clientFacture (idClient), INDEX id_plan (idPlan), PRIMARY KEY(numReservation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(20) NOT NULL, num_tel VARCHAR(20) NOT NULL, email VARCHAR(50) NOT NULL, mdp VARCHAR(100) NOT NULL, type VARCHAR(20) DEFAULT NULL, description VARCHAR(20) DEFAULT NULL, evaluation INT DEFAULT NULL, INDEX prenom (prenom), INDEX id (id), INDEX email (email), INDEX nom (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410A455ACCF FOREIGN KEY (idClient) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7D359FD231 FOREIGN KEY (pointDepart) REFERENCES place (id)');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7DDD5A8428 FOREIGN KEY (idGuide) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE plan_place ADD CONSTRAINT FK_27BB1631A2183FD4 FOREIGN KEY (idplace) REFERENCES place (id)');
        $this->addSql('ALTER TABLE plan_place ADD CONSTRAINT FK_27BB1631E95AADD FOREIGN KEY (idplan) REFERENCES plan (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7ACAEE414 FOREIGN KEY (rec_reference) REFERENCES reclamation (rec_reference)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71669B19B FOREIGN KEY (rec_id) REFERENCES reclamation (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955AEA705E3 FOREIGN KEY (idPlan) REFERENCES plan (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7D359FD231');
        $this->addSql('ALTER TABLE plan_place DROP FOREIGN KEY FK_27BB1631A2183FD4');
        $this->addSql('ALTER TABLE plan_place DROP FOREIGN KEY FK_27BB1631E95AADD');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955AEA705E3');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7ACAEE414');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71669B19B');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410A455ACCF');
        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7DDD5A8428');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A76ED395');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE `match`');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE plan');
        $this->addSql('DROP TABLE plan_image');
        $this->addSql('DROP TABLE plan_place');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE utilisateur');
    }
}
