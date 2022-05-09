<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220508193346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture ADD numReservation INT DEFAULT NULL, CHANGE idClient idClient INT DEFAULT NULL, CHANGE prix Total prix_Total DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410A455ACCF FOREIGN KEY (idClient) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641028087671 FOREIGN KEY (numReservation) REFERENCES reservation (numReservation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE86641028087671 ON facture (numReservation)');
        $this->addSql('DROP INDEX id_client ON facture');
        $this->addSql('CREATE INDEX IDX_FE866410A455ACCF ON facture (idClient)');
        $this->addSql('ALTER TABLE interest CHANGE sport sport TINYINT(1) NOT NULL, CHANGE history history TINYINT(1) NOT NULL, CHANGE food food TINYINT(1) NOT NULL, CHANGE health health TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE matching CHANGE client1 client1 INT DEFAULT NULL, CHANGE client2 client2 INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY idguide_fk');
        $this->addSql('ALTER TABLE plan CHANGE idGuide idGuide INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7DDD5A8428 FOREIGN KEY (idGuide) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE plan_place DROP FOREIGN KEY idplan');
        $this->addSql('ALTER TABLE plan_place DROP FOREIGN KEY idplace');
        $this->addSql('ALTER TABLE plan_place CHANGE ref ref INT AUTO_INCREMENT NOT NULL, CHANGE idplan idplan INT DEFAULT NULL, CHANGE idplace idplace INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plan_place ADD CONSTRAINT FK_27BB1631A2183FD4 FOREIGN KEY (idplace) REFERENCES place (id)');
        $this->addSql('ALTER TABLE plan_place ADD CONSTRAINT FK_27BB1631E95AADD FOREIGN KEY (idplan) REFERENCES plan (id)');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY reponse_ibfk_2');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY reponse_ibfk_1');
        $this->addSql('ALTER TABLE reponse CHANGE rec_reference rec_reference VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7ACAEE414 FOREIGN KEY (rec_reference) REFERENCES reclamation (rec_reference)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71669B19B FOREIGN KEY (rec_id) REFERENCES reclamation (id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY id_plan');
        $this->addSql('ALTER TABLE reservation ADD dateDebut DATE DEFAULT \'NULL\', ADD dateFin DATE DEFAULT \'NULL\', CHANGE idClient idClient INT DEFAULT NULL, CHANGE idPlan idPlan INT DEFAULT NULL, CHANGE nbrPlace nbrPlace INT DEFAULT NULL NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955AEA705E3 FOREIGN KEY (idPlan) REFERENCES plan (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A455ACCF FOREIGN KEY (idClient) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410A455ACCF');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641028087671');
        $this->addSql('DROP INDEX UNIQ_FE86641028087671 ON facture');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410A455ACCF');
        $this->addSql('ALTER TABLE facture DROP numReservation, CHANGE idClient idClient INT NOT NULL, CHANGE prix_Total prix Total DOUBLE PRECISION NOT NULL');
        $this->addSql('DROP INDEX idx_fe866410a455accf ON facture');
        $this->addSql('CREATE INDEX id_client ON facture (idClient)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410A455ACCF FOREIGN KEY (idClient) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE interest CHANGE sport sport INT NOT NULL, CHANGE history history INT NOT NULL, CHANGE food food INT NOT NULL, CHANGE health health INT NOT NULL');
        $this->addSql('ALTER TABLE matching CHANGE client1 client1 INT NOT NULL, CHANGE client2 client2 INT NOT NULL');
        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7DDD5A8428');
        $this->addSql('ALTER TABLE plan CHANGE idGuide idGuide INT NOT NULL');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT idguide_fk FOREIGN KEY (idGuide) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan_place DROP FOREIGN KEY FK_27BB1631A2183FD4');
        $this->addSql('ALTER TABLE plan_place DROP FOREIGN KEY FK_27BB1631E95AADD');
        $this->addSql('ALTER TABLE plan_place CHANGE ref ref INT NOT NULL, CHANGE idplace idplace INT NOT NULL, CHANGE idplan idplan INT NOT NULL');
        $this->addSql('ALTER TABLE plan_place ADD CONSTRAINT idplan FOREIGN KEY (idplan) REFERENCES plan (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan_place ADD CONSTRAINT idplace FOREIGN KEY (idplace) REFERENCES place (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A76ED395');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7ACAEE414');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71669B19B');
        $this->addSql('ALTER TABLE reponse CHANGE rec_reference rec_reference VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT reponse_ibfk_2 FOREIGN KEY (rec_id) REFERENCES reclamation (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT reponse_ibfk_1 FOREIGN KEY (rec_reference) REFERENCES reclamation (rec_reference) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955AEA705E3');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A455ACCF');
        $this->addSql('ALTER TABLE reservation DROP dateDebut, DROP dateFin, CHANGE nbrPlace nbrPlace INT NOT NULL, CHANGE idPlan idPlan INT NOT NULL, CHANGE idClient idClient INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT id_plan FOREIGN KEY (idPlan) REFERENCES plan (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
