<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220421182826 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Crear tablas `vehicle` y `model` y su realción';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE model (
            id VARCHAR(36) NOT NULL, name VARCHAR(100) NOT NULL, overview VARCHAR(1000) DEFAULT NULL, price_per_day DOUBLE PRECISION NOT NULL, fuel_type VARCHAR(50) NOT NULL, seating_capacity INT NOT NULL, image VARCHAR(255) DEFAULT NULL, gear_system VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_model_name (name), PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE vehicle (
            id VARCHAR(36) NOT NULL, model_id VARCHAR(36) DEFAULT NULL, plate_number VARCHAR(7) NOT NULL, availability_flag TINYINT(1) NOT NULL, registration_year INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_vehicle_model_id (model_id), UNIQUE INDEX UNIQ_vehicle_plateNumber (plate_number), PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_vehicle_model_id FOREIGN KEY (model_id) REFERENCES model (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_vehicle_model_id');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE vehicle');
    }
}
