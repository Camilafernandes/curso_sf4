<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190219142039 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cargo (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historico (id INT AUTO_INCREMENT NOT NULL, candidato_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, empresa VARCHAR(255) NOT NULL, data_entrada DATETIME NOT NULL, data_saida DATETIME NOT NULL, emprego_atual TINYINT(1) DEFAULT NULL, atribuicoes LONGTEXT DEFAULT NULL, INDEX IDX_8DAA356AFE0067E5 (candidato_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tecnologias (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidato (id INT AUTO_INCREMENT NOT NULL, cargo_id INT DEFAULT NULL, endereco_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, idade VARCHAR(255) NOT NULL, sexo VARCHAR(2) NOT NULL, data_nascimento DATETIME NOT NULL, pretensao_salarial DOUBLE PRECISION NOT NULL, foto VARCHAR(255) NOT NULL, INDEX IDX_2867675A813AC380 (cargo_id), UNIQUE INDEX UNIQ_2867675A1BB76823 (endereco_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidato_tecnologias (candidato_id INT NOT NULL, tecnologias_id INT NOT NULL, INDEX IDX_486BA1FFE0067E5 (candidato_id), INDEX IDX_486BA1FDA88D11C (tecnologias_id), PRIMARY KEY(candidato_id, tecnologias_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historico ADD CONSTRAINT FK_8DAA356AFE0067E5 FOREIGN KEY (candidato_id) REFERENCES candidato (id)');
        $this->addSql('ALTER TABLE candidato ADD CONSTRAINT FK_2867675A813AC380 FOREIGN KEY (cargo_id) REFERENCES cargo (id)');
        $this->addSql('ALTER TABLE candidato ADD CONSTRAINT FK_2867675A1BB76823 FOREIGN KEY (endereco_id) REFERENCES endereco (id)');
        $this->addSql('ALTER TABLE candidato_tecnologias ADD CONSTRAINT FK_486BA1FFE0067E5 FOREIGN KEY (candidato_id) REFERENCES candidato (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidato_tecnologias ADD CONSTRAINT FK_486BA1FDA88D11C FOREIGN KEY (tecnologias_id) REFERENCES tecnologias (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE endereco ADD numero VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidato DROP FOREIGN KEY FK_2867675A813AC380');
        $this->addSql('ALTER TABLE candidato_tecnologias DROP FOREIGN KEY FK_486BA1FDA88D11C');
        $this->addSql('ALTER TABLE historico DROP FOREIGN KEY FK_8DAA356AFE0067E5');
        $this->addSql('ALTER TABLE candidato_tecnologias DROP FOREIGN KEY FK_486BA1FFE0067E5');
        $this->addSql('DROP TABLE cargo');
        $this->addSql('DROP TABLE historico');
        $this->addSql('DROP TABLE tecnologias');
        $this->addSql('DROP TABLE candidato');
        $this->addSql('DROP TABLE candidato_tecnologias');
        $this->addSql('ALTER TABLE endereco DROP numero');
    }
}
