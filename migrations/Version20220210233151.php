<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210233151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_user (competence_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_CA0BDC5215761DAB (competence_id), INDEX IDX_CA0BDC52A76ED395 (user_id), PRIMARY KEY(competence_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_projet (competence_id INT NOT NULL, projet_id INT NOT NULL, INDEX IDX_19F6F9B515761DAB (competence_id), INDEX IDX_19F6F9B5C18272 (projet_id), PRIMARY KEY(competence_id, projet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, msg VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_user (message_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_24064D90537A1329 (message_id), INDEX IDX_24064D90A76ED395 (user_id), PRIMARY KEY(message_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, min_salaire DOUBLE PRECISION NOT NULL, max_salaire DOUBLE PRECISION NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_50159CA9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposition (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, user_id INT NOT NULL, prix INT NOT NULL, date_max DATE NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C7CDC353C18272 (projet_id), INDEX IDX_C7CDC353A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_723705D1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, date_naissance DATE DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, verified TINYINT(1) NOT NULL, code VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', banned TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence_user ADD CONSTRAINT FK_CA0BDC5215761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_user ADD CONSTRAINT FK_CA0BDC52A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_projet ADD CONSTRAINT FK_19F6F9B515761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_projet ADD CONSTRAINT FK_19F6F9B5C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_user ADD CONSTRAINT FK_24064D90537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_user ADD CONSTRAINT FK_24064D90A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC353C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC353A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence_user DROP FOREIGN KEY FK_CA0BDC5215761DAB');
        $this->addSql('ALTER TABLE competence_projet DROP FOREIGN KEY FK_19F6F9B515761DAB');
        $this->addSql('ALTER TABLE message_user DROP FOREIGN KEY FK_24064D90537A1329');
        $this->addSql('ALTER TABLE competence_projet DROP FOREIGN KEY FK_19F6F9B5C18272');
        $this->addSql('ALTER TABLE proposition DROP FOREIGN KEY FK_C7CDC353C18272');
        $this->addSql('ALTER TABLE competence_user DROP FOREIGN KEY FK_CA0BDC52A76ED395');
        $this->addSql('ALTER TABLE message_user DROP FOREIGN KEY FK_24064D90A76ED395');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9A76ED395');
        $this->addSql('ALTER TABLE proposition DROP FOREIGN KEY FK_C7CDC353A76ED395');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1A76ED395');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE competence_user');
        $this->addSql('DROP TABLE competence_projet');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_user');
        $this->addSql('DROP TABLE portfolio');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE proposition');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE user');
    }
}
