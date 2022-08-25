<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823141300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultant DROP FOREIGN KEY FK_441282A19D86650F');
        $this->addSql('DROP INDEX IDX_441282A19D86650F ON consultant');
        $this->addSql('ALTER TABLE consultant CHANGE user_id_id user_id_consultant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consultant ADD CONSTRAINT FK_441282A187CAEA1A FOREIGN KEY (user_id_consultant_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_441282A187CAEA1A ON consultant (user_id_consultant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultant DROP FOREIGN KEY FK_441282A187CAEA1A');
        $this->addSql('DROP INDEX IDX_441282A187CAEA1A ON consultant');
        $this->addSql('ALTER TABLE consultant CHANGE user_id_consultant_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consultant ADD CONSTRAINT FK_441282A19D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_441282A19D86650F ON consultant (user_id_id)');
    }
}
