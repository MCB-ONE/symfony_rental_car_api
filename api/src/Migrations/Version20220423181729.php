<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220423181729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Crear tabla `maker` y su relación con tabla `model`';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE maker (
            id VARCHAR(36) NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_maker_name (name), PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE model ADD maker_id VARCHAR(36) DEFAULT NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_model_maker_id FOREIGN KEY (maker_id) REFERENCES maker (id)');
        $this->addSql('CREATE INDEX IDX_model_maker_id ON model (maker_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_model_maker_id');
        $this->addSql('DROP TABLE maker');
        $this->addSql('DROP INDEX IDX_model_maker_id ON model');
        $this->addSql('ALTER TABLE model DROP maker_id');
    }
}
