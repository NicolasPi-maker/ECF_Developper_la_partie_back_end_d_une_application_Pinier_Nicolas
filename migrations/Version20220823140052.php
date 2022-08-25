<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823140052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recruiter DROP FOREIGN KEY FK_DE8633D89D86650F');
        $this->addSql('DROP INDEX IDX_DE8633D89D86650F ON recruiter');
        $this->addSql('ALTER TABLE recruiter CHANGE user_id_id user_id_recruiter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D82476FBBE FOREIGN KEY (user_id_recruiter_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DE8633D82476FBBE ON recruiter (user_id_recruiter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recruiter DROP FOREIGN KEY FK_DE8633D82476FBBE');
        $this->addSql('DROP INDEX IDX_DE8633D82476FBBE ON recruiter');
        $this->addSql('ALTER TABLE recruiter CHANGE user_id_recruiter_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D89D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DE8633D89D86650F ON recruiter (user_id_id)');
    }
}
