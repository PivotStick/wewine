<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200108091606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cellar (id INT AUTO_INCREMENT NOT NULL, id_user BIGINT DEFAULT NULL, content LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', max_content INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_9CA014636B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cellar_wine (cellar_id INT NOT NULL, wine_id BIGINT NOT NULL, INDEX IDX_E4C4150D4A8C468 (cellar_id), INDEX IDX_E4C415028A2BD76 (wine_id), PRIMARY KEY(cellar_id, wine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opinion (id INT AUTO_INCREMENT NOT NULL, id_user BIGINT NOT NULL, title VARCHAR(255) NOT NULL, content TEXT NOT NULL, rating INT NOT NULL, INDEX IDX_AB02B0276B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id BIGINT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, grade VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wine (id BIGINT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, domain VARCHAR(255) NOT NULL, vintage VARCHAR(5) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cellar ADD CONSTRAINT FK_9CA014636B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cellar_wine ADD CONSTRAINT FK_E4C4150D4A8C468 FOREIGN KEY (cellar_id) REFERENCES cellar (id)');
        $this->addSql('ALTER TABLE cellar_wine ADD CONSTRAINT FK_E4C415028A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B0276B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cellar_wine DROP FOREIGN KEY FK_E4C4150D4A8C468');
        $this->addSql('ALTER TABLE cellar DROP FOREIGN KEY FK_9CA014636B3CA4B');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B0276B3CA4B');
        $this->addSql('ALTER TABLE cellar_wine DROP FOREIGN KEY FK_E4C415028A2BD76');
        $this->addSql('DROP TABLE cellar');
        $this->addSql('DROP TABLE cellar_wine');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE wine');
    }
}
