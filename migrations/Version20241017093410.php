<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017093410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee_event DROP FOREIGN KEY FK_D3A307DE71F7E88B');
        $this->addSql('ALTER TABLE employee_event DROP FOREIGN KEY FK_D3A307DE8C03F15C');
        $this->addSql('DROP TABLE employee_event');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employee_event (employee_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_D3A307DE8C03F15C (employee_id), INDEX IDX_D3A307DE71F7E88B (event_id), PRIMARY KEY(employee_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE employee_event ADD CONSTRAINT FK_D3A307DE71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_event ADD CONSTRAINT FK_D3A307DE8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
    }
}
