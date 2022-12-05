<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205085100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_developer (game_id INT NOT NULL, developer_id INT NOT NULL, INDEX IDX_B75D4A98E48FD905 (game_id), INDEX IDX_B75D4A9864DD9267 (developer_id), PRIMARY KEY(game_id, developer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_developer ADD CONSTRAINT FK_B75D4A98E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_developer ADD CONSTRAINT FK_B75D4A9864DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_developer DROP FOREIGN KEY FK_B75D4A98E48FD905');
        $this->addSql('ALTER TABLE game_developer DROP FOREIGN KEY FK_B75D4A9864DD9267');
        $this->addSql('DROP TABLE game_developer');
    }
}
