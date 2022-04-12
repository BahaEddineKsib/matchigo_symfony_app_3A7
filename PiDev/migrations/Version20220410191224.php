<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220410191224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, blogs_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_E01FBE6A89C05BBC (blogs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A89C05BBC FOREIGN KEY (blogs_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY blog_ibfk_1');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY reponse_ibfk_2');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY reponse_ibfk_1');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7ACAEE414 FOREIGN KEY (rec_reference) REFERENCES reclamation (rec_reference)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71669B19B FOREIGN KEY (rec_id) REFERENCES reclamation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE images');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C0155143A76ED395');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT blog_ibfk_1 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A76ED395');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7ACAEE414');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71669B19B');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT reponse_ibfk_2 FOREIGN KEY (rec_id) REFERENCES reclamation (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT reponse_ibfk_1 FOREIGN KEY (rec_reference) REFERENCES reclamation (rec_reference) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
