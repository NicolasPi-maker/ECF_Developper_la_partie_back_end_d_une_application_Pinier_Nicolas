<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823145846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidate_job_offer_candidate (candidate_job_offer_id INT NOT NULL, candidate_id INT NOT NULL, INDEX IDX_506E983EF6977DE8 (candidate_job_offer_id), INDEX IDX_506E983E91BD8781 (candidate_id), PRIMARY KEY(candidate_job_offer_id, candidate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidate_job_offer_candidate ADD CONSTRAINT FK_506E983EF6977DE8 FOREIGN KEY (candidate_job_offer_id) REFERENCES candidate_job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_job_offer_candidate ADD CONSTRAINT FK_506E983E91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE candidate_candidate_job_offer');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidate_candidate_job_offer (candidate_id INT NOT NULL, candidate_job_offer_id INT NOT NULL, INDEX IDX_E774C3B391BD8781 (candidate_id), INDEX IDX_E774C3B3F6977DE8 (candidate_job_offer_id), PRIMARY KEY(candidate_id, candidate_job_offer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE candidate_candidate_job_offer ADD CONSTRAINT FK_E774C3B3F6977DE8 FOREIGN KEY (candidate_job_offer_id) REFERENCES candidate_job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_candidate_job_offer ADD CONSTRAINT FK_E774C3B391BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE candidate_job_offer_candidate');
    }
}
