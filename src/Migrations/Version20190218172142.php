<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190218172142 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE endereco (id INT AUTO_INCREMENT NOT NULL, logradouro VARCHAR(255) NOT NULL, cep VARCHAR(255) NOT NULL, cidade VARCHAR(255) NOT NULL, estado VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contato ADD endereco_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contato ADD CONSTRAINT FK_C384AB421BB76823 FOREIGN KEY (endereco_id) REFERENCES endereco (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C384AB421BB76823 ON contato (endereco_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contato DROP FOREIGN KEY FK_C384AB421BB76823');
        $this->addSql('DROP TABLE endereco');
        $this->addSql('DROP INDEX UNIQ_C384AB421BB76823 ON contato');
        $this->addSql('ALTER TABLE contato DROP endereco_id');
    }
}
