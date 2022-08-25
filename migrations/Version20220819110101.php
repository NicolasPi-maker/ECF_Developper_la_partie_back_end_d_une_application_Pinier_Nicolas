<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220819110101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer ADD CONSTRAINT FK_B0562C34F6977DE8 FOREIGN KEY (candidate_job_offer_id) REFERENCES candidate_job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer ADD CONSTRAINT FK_B0562C343481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer DROP FOREIGN KEY FK_B0562C34F6977DE8');
        $this->addSql('ALTER TABLE candidate_job_offer_job_offer DROP FOREIGN KEY FK_B0562C343481D195');
    }
}
