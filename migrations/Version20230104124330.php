<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104124330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sport DROP FOREIGN KEY FK_1A85EFD2296CD8AE');
        $this->addSql('DROP INDEX IDX_1A85EFD2296CD8AE ON sport');
        $this->addSql('ALTER TABLE sport DROP team_id');
        $this->addSql('ALTER TABLE team ADD sport_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61FAC78BCF8 ON team (sport_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sport ADD team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sport ADD CONSTRAINT FK_1A85EFD2296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_1A85EFD2296CD8AE ON sport (team_id)');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FAC78BCF8');
        $this->addSql('DROP INDEX IDX_C4E0A61FAC78BCF8 ON team');
        $this->addSql('ALTER TABLE team DROP sport_id');
    }
}
