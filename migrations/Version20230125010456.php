<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125010456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parsed_files_mor CHANGE record_type_code record_type_code VARCHAR(2) NOT NULL, CHANGE mbi mbi VARCHAR(50) NOT NULL, CHANGE last_name last_name VARCHAR(50) NOT NULL, CHANGE first_name first_name VARCHAR(50) NOT NULL, CHANGE initial initial VARCHAR(2) NOT NULL, CHANGE dob_string dob_string VARCHAR(50) NOT NULL, CHANGE sex sex SMALLINT NOT NULL, CHANGE description_string description_string VARCHAR(500) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parsed_files_mor CHANGE record_type_code record_type_code CHAR(2) DEFAULT NULL, CHANGE mbi mbi VARCHAR(50) DEFAULT NULL, CHANGE last_name last_name VARCHAR(50) DEFAULT NULL, CHANGE first_name first_name VARCHAR(50) DEFAULT NULL, CHANGE initial initial CHAR(2) DEFAULT NULL, CHANGE dob_string dob_string VARCHAR(50) DEFAULT NULL, CHANGE sex sex TINYINT(1) DEFAULT NULL, CHANGE description_string description_string VARCHAR(500) DEFAULT NULL');
    }
}
