<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220416164032 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Crear tabla `model` y su relacion con tabla `vehicle`';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE model (
            id VARCHAR(36) NOT NULL, name VARCHAR(100) NOT NULL, overview VARCHAR(1000) DEFAULT NULL, price_per_day Decimal(3, 2) NOT NULL, stock INT NOT NULL, availability_flag TINYINT(1) NOT NULL, fuel_type VARCHAR(50) NOT NULL, seating_capacity INT NOT NULL, image VARCHAR(255) DEFAULT NULL, gear_system VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, 
            PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicle ADD model_id VARCHAR(36) DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_vehicle_model_id FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('CREATE INDEX IDX_vehicle_model_id ON vehicle (model_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4867975B7E7');
        $this->addSql('DROP TABLE model');
        $this->addSql('ALTER TABLE user CHANGE id id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('CREATE INDEX IDX_user_email ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX U_user_email ON user (email)');
        $this->addSql('DROP INDEX IDX_vehicle_model_id ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP model_id');
    }
}
