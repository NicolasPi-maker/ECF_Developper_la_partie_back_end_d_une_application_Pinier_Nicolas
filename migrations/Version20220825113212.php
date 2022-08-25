<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220825113212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate_job_offer ADD test_fields_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidate_job_offer ADD CONSTRAINT FK_37F1E762AEC9AE64 FOREIGN KEY (test_fields_id) REFERENCES job_offer (id)');
        $this->addSql('CREATE INDEX IDX_37F1E762AEC9AE64 ON candidate_job_offer (test_fields_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate_job_offer DROP FOREIGN KEY FK_37F1E762AEC9AE64');
        $this->addSql('DROP INDEX IDX_37F1E762AEC9AE64 ON candidate_job_offer');
        $this->addSql('ALTER TABLE candidate_job_offer DROP test_fields_id');
    }
}
