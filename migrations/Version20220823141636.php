<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823141636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D769D86650F');
        $this->addSql('DROP INDEX IDX_880E0D769D86650F ON admin');
        $this->addSql('ALTER TABLE admin CHANGE user_id_id user_id_admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D769DEBA710 FOREIGN KEY (user_id_admin_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_880E0D769DEBA710 ON admin (user_id_admin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D769DEBA710');
        $this->addSql('DROP INDEX IDX_880E0D769DEBA710 ON admin');
        $this->addSql('ALTER TABLE admin CHANGE user_id_admin_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D769D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_880E0D769D86650F ON admin (user_id_id)');
    }
}
