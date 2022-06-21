<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220621203338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking_room (id INT AUTO_INCREMENT NOT NULL, id_users_id INT DEFAULT NULL, id_payment_token_id INT DEFAULT NULL, start_date DATETIME DEFAULT NULL, end_date DATETIME DEFAULT NULL, INDEX IDX_6A0E73D5376858A8 (id_users_id), INDEX IDX_6A0E73D5E292F000 (id_payment_token_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel_locations (id INT AUTO_INCREMENT NOT NULL, booking_room_id INT NOT NULL, country VARCHAR(255) DEFAULT NULL, post_code VARCHAR(15) DEFAULT NULL, city VARCHAR(40) DEFAULT NULL, street VARCHAR(50) DEFAULT NULL, home_number VARCHAR(10) DEFAULT NULL, room_number VARCHAR(5) DEFAULT NULL, INDEX IDX_A9AF3B78EA935B3 (booking_room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_token (id INT AUTO_INCREMENT NOT NULL, type_of_payment VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rooms (id INT AUTO_INCREMENT NOT NULL, id_status_id INT DEFAULT NULL, room_name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, beds INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_7CA11A96EBC2BC9A (id_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, id_country_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone_number INT DEFAULT NULL, first_name VARCHAR(25) DEFAULT NULL, last_name VARCHAR(25) DEFAULT NULL, post_code VARCHAR(15) DEFAULT NULL, city VARCHAR(40) DEFAULT NULL, street VARCHAR(50) DEFAULT NULL, home_number VARCHAR(10) DEFAULT NULL, apartment_number VARCHAR(5) DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E95CA5BEA7 (id_country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_room ADD CONSTRAINT FK_6A0E73D5376858A8 FOREIGN KEY (id_users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE booking_room ADD CONSTRAINT FK_6A0E73D5E292F000 FOREIGN KEY (id_payment_token_id) REFERENCES payment_token (id)');
        $this->addSql('ALTER TABLE hotel_locations ADD CONSTRAINT FK_A9AF3B78EA935B3 FOREIGN KEY (booking_room_id) REFERENCES booking_room (id)');
        $this->addSql('ALTER TABLE rooms ADD CONSTRAINT FK_7CA11A96EBC2BC9A FOREIGN KEY (id_status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E95CA5BEA7 FOREIGN KEY (id_country_id) REFERENCES country (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hotel_locations DROP FOREIGN KEY FK_A9AF3B78EA935B3');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E95CA5BEA7');
        $this->addSql('ALTER TABLE booking_room DROP FOREIGN KEY FK_6A0E73D5E292F000');
        $this->addSql('ALTER TABLE rooms DROP FOREIGN KEY FK_7CA11A96EBC2BC9A');
        $this->addSql('ALTER TABLE booking_room DROP FOREIGN KEY FK_6A0E73D5376858A8');
        $this->addSql('DROP TABLE booking_room');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE hotel_locations');
        $this->addSql('DROP TABLE payment_token');
        $this->addSql('DROP TABLE rooms');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
