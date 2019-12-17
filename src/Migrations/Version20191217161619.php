<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191217161619 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B0276B3CA4B');
        $this->addSql('ALTER TABLE opinion CHANGE id_user id_user BIGINT NOT NULL');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B0276B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B0276B3CA4B');
        $this->addSql('ALTER TABLE opinion CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B0276B3CA4B FOREIGN KEY (id_user) REFERENCES opinion (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
