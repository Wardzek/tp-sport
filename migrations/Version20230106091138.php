<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230106091138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE athete DROP FOREIGN KEY FK_B83DC451296CD8AE');
        $this->addSql('ALTER TABLE athete ADD CONSTRAINT FK_B83DC451296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE athete DROP FOREIGN KEY FK_B83DC451296CD8AE');
        $this->addSql('ALTER TABLE athete ADD CONSTRAINT FK_B83DC451296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
    }
}
