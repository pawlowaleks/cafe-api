<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315150413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `check` (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3C8EAC1319EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE check_dish (check_id INT NOT NULL, dish_id INT NOT NULL, INDEX IDX_70FDF839709385E7 (check_id), INDEX IDX_70FDF839148EB0CB (dish_id), PRIMARY KEY(check_id, dish_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cook (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, cook_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_957D8CB8B0D5B835 (cook_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `check` ADD CONSTRAINT FK_3C8EAC1319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE check_dish ADD CONSTRAINT FK_70FDF839709385E7 FOREIGN KEY (check_id) REFERENCES `check` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE check_dish ADD CONSTRAINT FK_70FDF839148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB8B0D5B835 FOREIGN KEY (cook_id) REFERENCES cook (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE check_dish DROP FOREIGN KEY FK_70FDF839709385E7');
        $this->addSql('ALTER TABLE `check` DROP FOREIGN KEY FK_3C8EAC1319EB6921');
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB8B0D5B835');
        $this->addSql('ALTER TABLE check_dish DROP FOREIGN KEY FK_70FDF839148EB0CB');
        $this->addSql('DROP TABLE `check`');
        $this->addSql('DROP TABLE check_dish');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE cook');
        $this->addSql('DROP TABLE dish');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
