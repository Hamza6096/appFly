<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428090326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flight ADD departure_city_id INT NOT NULL, ADD arrival_city_id INT NOT NULL, DROP departure_city, CHANGE promo reduction TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E918B251E FOREIGN KEY (departure_city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E4067ACA7 FOREIGN KEY (arrival_city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_C257E60E918B251E ON flight (departure_city_id)');
        $this->addSql('CREATE INDEX IDX_C257E60E4067ACA7 ON flight (arrival_city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E918B251E');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E4067ACA7');
        $this->addSql('DROP INDEX IDX_C257E60E918B251E ON flight');
        $this->addSql('DROP INDEX IDX_C257E60E4067ACA7 ON flight');
        $this->addSql('ALTER TABLE flight ADD departure_city DATETIME NOT NULL, DROP departure_city_id, DROP arrival_city_id, CHANGE reduction promo TINYINT(1) NOT NULL');
    }
}
