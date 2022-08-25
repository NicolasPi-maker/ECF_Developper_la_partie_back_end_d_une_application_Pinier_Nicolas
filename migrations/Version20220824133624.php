<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220824133624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_offer_candidate_job_offer (job_offer_id INT NOT NULL, candidate_job_offer_id INT NOT NULL, INDEX IDX_5B032DE33481D195 (job_offer_id), INDEX IDX_5B032DE3F6977DE8 (candidate_job_offer_id), PRIMARY KEY(job_offer_id, candidate_job_offer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_offer_candidate_job_offer ADD CONSTRAINT FK_5B032DE33481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_offer_candidate_job_offer ADD CONSTRAINT FK_5B032DE3F6977DE8 FOREIGN KEY (candidate_job_offer_id) REFERENCES candidate_job_offer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE job_offer_candidate_job_offer');
    }
}
