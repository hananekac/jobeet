<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106152833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE affiliate_category (affiliate_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CEC6AF8A9F12C49A (affiliate_id), INDEX IDX_CEC6AF8A12469DE2 (category_id), PRIMARY KEY(affiliate_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affiliate_category ADD CONSTRAINT FK_CEC6AF8A9F12C49A FOREIGN KEY (affiliate_id) REFERENCES affiliate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE affiliate_category ADD CONSTRAINT FK_CEC6AF8A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE affiliate ADD active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F812469DE2 ON job (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE affiliate_category');
        $this->addSql('ALTER TABLE affiliate DROP active');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F812469DE2');
        $this->addSql('DROP INDEX IDX_FBD8E0F812469DE2 ON job');
        $this->addSql('ALTER TABLE job DROP category_id');
    }
}
