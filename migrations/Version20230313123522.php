<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313123522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE praticien (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, visiteur_id INT DEFAULT NULL, praticiens_id INT DEFAULT NULL, date_visite DATETIME NOT NULL, commentaire VARCHAR(255) NOT NULL, INDEX IDX_B09C8CBB7F72333D (visiteur_id), INDEX IDX_B09C8CBB3D329473 (praticiens_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiteur (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiteur_praticien (visiteur_id INT NOT NULL, praticien_id INT NOT NULL, INDEX IDX_298AC7497F72333D (visiteur_id), INDEX IDX_298AC7492391866B (praticien_id), PRIMARY KEY(visiteur_id, praticien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB7F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB3D329473 FOREIGN KEY (praticiens_id) REFERENCES praticien (id)');
        $this->addSql('ALTER TABLE visiteur_praticien ADD CONSTRAINT FK_298AC7497F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visiteur_praticien ADD CONSTRAINT FK_298AC7492391866B FOREIGN KEY (praticien_id) REFERENCES praticien (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB7F72333D');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB3D329473');
        $this->addSql('ALTER TABLE visiteur_praticien DROP FOREIGN KEY FK_298AC7497F72333D');
        $this->addSql('ALTER TABLE visiteur_praticien DROP FOREIGN KEY FK_298AC7492391866B');
        $this->addSql('DROP TABLE praticien');
        $this->addSql('DROP TABLE visite');
        $this->addSql('DROP TABLE visiteur');
        $this->addSql('DROP TABLE visiteur_praticien');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
