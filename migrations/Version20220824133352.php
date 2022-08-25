<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220824133352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE candidate_job_offer_job_offer');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidate_job_offer_job_offer (candidate_job_offer_id_job INT NOT NULL, job_offer_id INT NOT NULL, INDEX IDX_B0562C34F6977DE8 (candidate_job_offer_id_job), INDEX IDX_B0562C343481D195 (job_offer_id), PRIMARY KEY(candidate_job_offer_id_job, job_offer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer ADD CONSTRAINT FK_B0562C343481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer ADD CONSTRAINT FK_B0562C34F6977DE8 FOREIGN KEY (candidate_job_offer_id_job) REFERENCES candidate_job_offer (id) ON DELETE CASCADE');
    }
}
