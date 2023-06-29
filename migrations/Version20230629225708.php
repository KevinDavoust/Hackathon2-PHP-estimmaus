<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629225708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, picture_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) DEFAULT NULL, val_min INT DEFAULT NULL, val_max INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, zip_code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE indicator (id INT AUTO_INCREMENT NOT NULL, characteristic VARCHAR(255) NOT NULL, classification VARCHAR(255) NOT NULL, value INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE memory (id INT AUTO_INCREMENT NOT NULL, size INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, year INT DEFAULT NULL, picture_path VARCHAR(255) DEFAULT NULL, indicator VARCHAR(255) DEFAULT NULL, INDEX IDX_D79572D944F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE smartphone (id INT AUTO_INCREMENT NOT NULL, model_id INT DEFAULT NULL, memory_id INT DEFAULT NULL, storage_id INT DEFAULT NULL, state_id INT DEFAULT NULL, category_id INT DEFAULT NULL, city_id INT DEFAULT NULL, total_indice DOUBLE PRECISION DEFAULT NULL, INDEX IDX_26B07E2E7975B7E7 (model_id), INDEX IDX_26B07E2ECCC80CB3 (memory_id), INDEX IDX_26B07E2E5CC5DB90 (storage_id), INDEX IDX_26B07E2E5D83CC1 (state_id), INDEX IDX_26B07E2E12469DE2 (category_id), INDEX IDX_26B07E2E8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, percentage DOUBLE PRECISION DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE storage (id INT AUTO_INCREMENT NOT NULL, size INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6498BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2ECCC80CB3 FOREIGN KEY (memory_id) REFERENCES memory (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E5CC5DB90 FOREIGN KEY (storage_id) REFERENCES storage (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E5D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6498BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E7975B7E7');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2ECCC80CB3');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E5CC5DB90');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E5D83CC1');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E12469DE2');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E8BAC62AF');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6498BAC62AF');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE indicator');
        $this->addSql('DROP TABLE memory');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE smartphone');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE storage');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
