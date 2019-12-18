<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191218090131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cellar_wine (cellar_id INT NOT NULL, wine_id BIGINT NOT NULL, INDEX IDX_E4C4150D4A8C468 (cellar_id), INDEX IDX_E4C415028A2BD76 (wine_id), PRIMARY KEY(cellar_id, wine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cellar_wine ADD CONSTRAINT FK_E4C4150D4A8C468 FOREIGN KEY (cellar_id) REFERENCES cellar (id)');
        $this->addSql('ALTER TABLE cellar_wine ADD CONSTRAINT FK_E4C415028A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cellar_wine');
    }
}
