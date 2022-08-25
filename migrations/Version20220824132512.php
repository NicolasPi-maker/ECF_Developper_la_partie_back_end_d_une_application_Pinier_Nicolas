<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220824132512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer DROP FOREIGN KEY FK_B0562C34F6977DE8');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer DROP PRIMARY KEY');
        $this->addSql('DROP INDEX IDX_B0562C34F6977DE8 ON candidate_job_offer_job_offer');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer CHANGE candidate_job_offer_id_job candidate_job_offer_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer ADD CONSTRAINT FK_B0562C34F6977DE9 FOREIGN KEY (candidate_job_offer_id_job) REFERENCES candidate_job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer ADD PRIMARY KEY (candidate_job_offer_id, job_offer_id)');
        $this->addSql('CREATE INDEX IDX_B0562C34F6977DE8 ON candidate_job_offer_job_offer (candidate_job_offer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer DROP FOREIGN KEY FK_B0562C34F6977DE8');
        $this->addSql('DROP INDEX IDX_B0562C34F6977DE8 ON candidate_job_offer_job_offer');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer CHANGE candidate_job_offer_id candidate_job_offer_id_job INT NOT NULL');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer ADD CONSTRAINT FK_B0562C34F6977DE8 FOREIGN KEY (candidate_job_offer_id_job) REFERENCES candidate_job_offer (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_B0562C34F6977DE8 ON candidate_job_offer_job_offer (candidate_job_offer_id_job)');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer ADD PRIMARY KEY (candidate_job_offer_id_job, job_offer_id)');
    }
}
