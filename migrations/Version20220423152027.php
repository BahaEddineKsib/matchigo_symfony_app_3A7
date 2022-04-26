<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220423152027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment_dislike (id INT AUTO_INCREMENT NOT NULL, comm_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_D488EBAEF7EB489 (comm_id), INDEX IDX_D488EBAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_dislike ADD CONSTRAINT FK_D488EBAEF7EB489 FOREIGN KEY (comm_id) REFERENCES commentaire (idComm)');
        $this->addSql('ALTER TABLE comment_dislike ADD CONSTRAINT FK_D488EBAA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE comment_dislike');
    }
}
