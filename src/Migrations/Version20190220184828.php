<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190220184828 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, nome VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidatos_tecnologias (candidato_id INT NOT NULL, tecnologias_id INT NOT NULL, INDEX IDX_98D23093FE0067E5 (candidato_id), INDEX IDX_98D23093DA88D11C (tecnologias_id), PRIMARY KEY(candidato_id, tecnologias_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidatos_tecnologias ADD CONSTRAINT FK_98D23093FE0067E5 FOREIGN KEY (candidato_id) REFERENCES candidato (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidatos_tecnologias ADD CONSTRAINT FK_98D23093DA88D11C FOREIGN KEY (tecnologias_id) REFERENCES tecnologias (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE candidato_tecnologias');
        $this->addSql('ALTER TABLE candidato DROP INDEX UNIQ_2867675A1BB76823, ADD INDEX IDX_2867675A1BB76823 (endereco_id)');
        $this->addSql('ALTER TABLE candidato CHANGE idade idade INT NOT NULL, CHANGE sexo sexo VARCHAR(1) NOT NULL, CHANGE data_nascimento data_nascimento DATE NOT NULL, CHANGE pretensao_salarial pretensao_salarial NUMERIC(2, 0) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE candidato_tecnologias (candidato_id INT NOT NULL, tecnologias_id INT NOT NULL, INDEX IDX_486BA1FDA88D11C (tecnologias_id), INDEX IDX_486BA1FFE0067E5 (candidato_id), PRIMARY KEY(candidato_id, tecnologias_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE candidato_tecnologias ADD CONSTRAINT FK_486BA1FDA88D11C FOREIGN KEY (tecnologias_id) REFERENCES tecnologias (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidato_tecnologias ADD CONSTRAINT FK_486BA1FFE0067E5 FOREIGN KEY (candidato_id) REFERENCES candidato (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE candidatos_tecnologias');
        $this->addSql('ALTER TABLE candidato DROP INDEX IDX_2867675A1BB76823, ADD UNIQUE INDEX UNIQ_2867675A1BB76823 (endereco_id)');
        $this->addSql('ALTER TABLE candidato CHANGE idade idade VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE sexo sexo VARCHAR(2) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE data_nascimento data_nascimento DATETIME NOT NULL, CHANGE pretensao_salarial pretensao_salarial DOUBLE PRECISION NOT NULL');
    }
}
