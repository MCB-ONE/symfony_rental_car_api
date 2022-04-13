<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220413111040 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Crear tablas `vehicle` y `brand` y su relación';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        
        $this->addSql(
            'CREATE TABLE brand (
                id VARCHAR(36) NOT NULL,
                name VARCHAR(100) NOT NULL, 
                created_at DATETIME NOT NULL, 
                updated_at DATETIME NOT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE vehicle (
                id VARCHAR(36) NOT NULL, 
                brand_id VARCHAR(36) DEFAULT NULL, 
                model VARCHAR(100) NOT NULL, 
                overview VARCHAR(1000) DEFAULT NULL, 
                price_per_day DECIMAL(5,2) NOT NULL, 
                stock INT NOT NULL, 
                availability_flag TINYINT(1) NOT NULL, 
                fuel_type VARCHAR(50) NOT NULL, 
                model_year INT NOT NULL, 
                seating_capacity INT NOT NULL, 
                image VARCHAR(255) DEFAULT NULL, 
                gear_system VARCHAR(50) NOT NULL, 
                created_at DATETIME NOT NULL, 
                updated_at DATETIME NOT NULL, 
                INDEX IDX_vehicle_brand_id (brand_id), 
                PRIMARY KEY(id)
            ) 
            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_vehicle_brand_id FOREIGN KEY (brand_id) REFERENCES brand (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_vehicle_brand_id');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE vehicle');
    }
}
