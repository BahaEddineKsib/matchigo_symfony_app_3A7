<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220508200012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY facture_ibfk_1');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641028087671 FOREIGN KEY (numReservation) REFERENCES reservation (numReservation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE86641028087671 ON facture (numReservation)');
        $this->addSql('DROP INDEX id_client ON facture');
        $this->addSql('CREATE INDEX IDX_FE866410A455ACCF ON facture (idClient)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT facture_ibfk_1 FOREIGN KEY (idClient) REFERENCES utilisateur (id)');
        $this->addSql('DROP INDEX numRes ON plan');
        $this->addSql('ALTER TABLE plan DROP NumReservation');
        $this->addSql('ALTER TABLE plan_place ADD CONSTRAINT FK_27BB1631E95AADD FOREIGN KEY (idplan) REFERENCES plan (id)');
        $this->addSql('ALTER TABLE plan_place ADD CONSTRAINT FK_27BB1631A2183FD4 FOREIGN KEY (idplace) REFERENCES place (id)');
        $this->addSql('DROP INDEX idplan ON plan_place');
        $this->addSql('CREATE INDEX IDX_27BB1631E95AADD ON plan_place (idplan)');
        $this->addSql('DROP INDEX idplace ON plan_place');
        $this->addSql('CREATE INDEX IDX_27BB1631A2183FD4 ON plan_place (idplace)');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY email_rec');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY prenom_rec');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY nom_rec');
        $this->addSql('ALTER TABLE reclamation CHANGE nom nom VARCHAR(20) DEFAULT NULL, CHANGE prenom prenom VARCHAR(20) DEFAULT NULL, CHANGE email email VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404A625945B FOREIGN KEY (prenom) REFERENCES utilisateur (prenom)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE6064046C6E55B5 FOREIGN KEY (nom) REFERENCES utilisateur (nom)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404E7927C74 FOREIGN KEY (email) REFERENCES utilisateur (email)');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY client_rep');
        $this->addSql('ALTER TABLE reponse CHANGE user_id user_id INT DEFAULT NULL, CHANGE rec_reference rec_reference VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY clientFacture');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY id_plan');
        $this->addSql('ALTER TABLE reservation CHANGE idClient idClient INT DEFAULT NULL, CHANGE idPlan idPlan INT DEFAULT NULL, CHANGE nbrPlace nbrPlace INT DEFAULT NULL NOT NULL, CHANGE dateDebut dateDebut DATE DEFAULT \'NULL\', CHANGE dateFin dateFin DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955AEA705E3 FOREIGN KEY (idPlan) REFERENCES plan (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A455ACCF FOREIGN KEY (idClient) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE type type VARCHAR(20) DEFAULT \'NULL\', CHANGE description description VARCHAR(20) DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641028087671');
        $this->addSql('DROP INDEX UNIQ_FE86641028087671 ON facture');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410A455ACCF');
        $this->addSql('DROP INDEX idx_fe866410a455accf ON facture');
        $this->addSql('CREATE INDEX id_client ON facture (idClient)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410A455ACCF FOREIGN KEY (idClient) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE plan ADD NumReservation INT NOT NULL');
        $this->addSql('CREATE INDEX numRes ON plan (NumReservation)');
        $this->addSql('ALTER TABLE plan_place DROP FOREIGN KEY FK_27BB1631E95AADD');
        $this->addSql('ALTER TABLE plan_place DROP FOREIGN KEY FK_27BB1631A2183FD4');
        $this->addSql('ALTER TABLE plan_place DROP FOREIGN KEY FK_27BB1631E95AADD');
        $this->addSql('ALTER TABLE plan_place DROP FOREIGN KEY FK_27BB1631A2183FD4');
        $this->addSql('DROP INDEX idx_27bb1631a2183fd4 ON plan_place');
        $this->addSql('CREATE INDEX idplace ON plan_place (idplace)');
        $this->addSql('DROP INDEX idx_27bb1631e95aadd ON plan_place');
        $this->addSql('CREATE INDEX idplan ON plan_place (idplan)');
        $this->addSql('ALTER TABLE plan_place ADD CONSTRAINT FK_27BB1631E95AADD FOREIGN KEY (idplan) REFERENCES plan (id)');
        $this->addSql('ALTER TABLE plan_place ADD CONSTRAINT FK_27BB1631A2183FD4 FOREIGN KEY (idplace) REFERENCES place (id)');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A625945B');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE6064046C6E55B5');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404E7927C74');
        $this->addSql('ALTER TABLE reclamation CHANGE prenom prenom VARCHAR(40) NOT NULL, CHANGE nom nom VARCHAR(40) NOT NULL, CHANGE email email VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT email_rec FOREIGN KEY (email) REFERENCES utilisateur (email) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT prenom_rec FOREIGN KEY (prenom) REFERENCES utilisateur (prenom) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT nom_rec FOREIGN KEY (nom) REFERENCES utilisateur (nom) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A76ED395');
        $this->addSql('ALTER TABLE reponse CHANGE rec_reference rec_reference VARCHAR(50) NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT client_rep FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955AEA705E3');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A455ACCF');
        $this->addSql('ALTER TABLE reservation CHANGE nbrPlace nbrPlace INT DEFAULT NULL, CHANGE dateDebut dateDebut DATE DEFAULT NULL, CHANGE dateFin dateFin DATE DEFAULT NULL, CHANGE idPlan idPlan INT NOT NULL, CHANGE idClient idClient INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT clientFacture FOREIGN KEY (idClient) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT id_plan FOREIGN KEY (idPlan) REFERENCES plan (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur CHANGE type type VARCHAR(20) DEFAULT NULL, CHANGE description description VARCHAR(20) DEFAULT NULL');
    }
}
