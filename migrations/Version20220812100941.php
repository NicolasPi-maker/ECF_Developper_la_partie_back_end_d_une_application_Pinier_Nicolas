<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812100941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidate_job_offer (id INT AUTO_INCREMENT NOT NULL, is_checked TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate_job_offer_job_offer (candidate_job_offer_id INT NOT NULL, job_offer_id INT NOT NULL, INDEX IDX_B0562C34F6977DE8 (candidate_job_offer_id), INDEX IDX_B0562C343481D195 (job_offer_id), PRIMARY KEY(candidate_job_offer_id, job_offer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate_job_offer_candidate (candidate_job_offer_id INT NOT NULL, candidate_id INT NOT NULL, INDEX IDX_506E983EF6977DE8 (candidate_job_offer_id), INDEX IDX_506E983E91BD8781 (candidate_id), PRIMARY KEY(candidate_job_offer_id, candidate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, address VARCHAR(120) NOT NULL, postale_code VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, recruiter_id_id INT DEFAULT NULL, title VARCHAR(60) NOT NULL, location VARCHAR(120) NOT NULL, description VARCHAR(240) NOT NULL, is_checked TINYINT(1) DEFAULT NULL, INDEX IDX_288A3A4EA2B5DF02 (recruiter_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruiter (id INT AUTO_INCREMENT NOT NULL, id_company_id INT DEFAULT NULL, user_id_id INT DEFAULT NULL, INDEX IDX_DE8633D832119A01 (id_company_id), INDEX IDX_DE8633D89D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer ADD CONSTRAINT FK_B0562C34F6977DE8 FOREIGN KEY (candidate_job_offer_id) REFERENCES candidate_job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer ADD CONSTRAINT FK_B0562C343481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_job_offer_candidate ADD CONSTRAINT FK_506E983EF6977DE8 FOREIGN KEY (candidate_job_offer_id) REFERENCES candidate_job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_job_offer_candidate ADD CONSTRAINT FK_506E983E91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EA2B5DF02 FOREIGN KEY (recruiter_id_id) REFERENCES recruiter (id)');
        $this->addSql('ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D832119A01 FOREIGN KEY (id_company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D89D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer DROP FOREIGN KEY FK_B0562C34F6977DE8');
        $this->addSql('ALTER TABLE candidate_job_offer_candidate DROP FOREIGN KEY FK_506E983EF6977DE8');
        $this->addSql('ALTER TABLE recruiter DROP FOREIGN KEY FK_DE8633D832119A01');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer DROP FOREIGN KEY FK_B0562C343481D195');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EA2B5DF02');
        $this->addSql('DROP TABLE candidate_job_offer');
        $this->addSql('DROP TABLE candidate_job_offer_job_offer');
        $this->addSql('DROP TABLE candidate_job_offer_candidate');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE recruiter');
    }
}
