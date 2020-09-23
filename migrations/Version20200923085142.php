<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200923085142 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soustheme (id INT AUTO_INCREMENT NOT NULL, theme_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_445DC95F59027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, competence_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_9775E70815761DAB (competence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE soustheme ADD CONSTRAINT FK_445DC95F59027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E70815761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E70815761DAB');
        $this->addSql('ALTER TABLE soustheme DROP FOREIGN KEY FK_445DC95F59027487');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE soustheme');
        $this->addSql('DROP TABLE theme');
    }
}
