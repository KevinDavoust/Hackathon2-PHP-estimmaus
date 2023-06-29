<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629162651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE smartphone ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_26B07E2E8BAC62AF ON smartphone (city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E8BAC62AF');
        $this->addSql('DROP INDEX IDX_26B07E2E8BAC62AF ON smartphone');
        $this->addSql('ALTER TABLE smartphone DROP city_id');
    }
}
