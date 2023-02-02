<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124235440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE IF NOT EXISTS parsed_files_mor (
                id                  INT NOT NULL auto_increment,
                record_type_code    CHAR(2),
                mbi                 VARCHAR(50),
                last_name           VARCHAR(50),
                first_name          VARCHAR(50),
                initial             CHAR(2),
                dob_string          VARCHAR(50),
                sex                 TINYINT UNSIGNED,
                description_string  VARCHAR(500),
                PRIMARY KEY (id)
            ) ENGINE=INNODB;
        ');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE mor_parsed_files');

    }
}
