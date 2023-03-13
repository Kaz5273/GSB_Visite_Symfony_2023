<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313125748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, date_embauche DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_praticien (user_id INT NOT NULL, praticien_id INT NOT NULL, INDEX IDX_D7AAA37A76ED395 (user_id), INDEX IDX_D7AAA372391866B (praticien_id), PRIMARY KEY(user_id, praticien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_praticien ADD CONSTRAINT FK_D7AAA37A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_praticien ADD CONSTRAINT FK_D7AAA372391866B FOREIGN KEY (praticien_id) REFERENCES praticien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visite ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B09C8CBBA76ED395 ON visite (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBA76ED395');
        $this->addSql('ALTER TABLE user_praticien DROP FOREIGN KEY FK_D7AAA37A76ED395');
        $this->addSql('ALTER TABLE user_praticien DROP FOREIGN KEY FK_D7AAA372391866B');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_praticien');
        $this->addSql('DROP INDEX IDX_B09C8CBBA76ED395 ON visite');
        $this->addSql('ALTER TABLE visite DROP user_id');
    }
}
