<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200514072228 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE receipt_ingrediant (receipt_id INT NOT NULL, ingrediant_id INT NOT NULL, INDEX IDX_96856E472B5CA896 (receipt_id), INDEX IDX_96856E478AEA29A (ingrediant_id), PRIMARY KEY(receipt_id, ingrediant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE receipt_ingrediant ADD CONSTRAINT FK_96856E472B5CA896 FOREIGN KEY (receipt_id) REFERENCES receipt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE receipt_ingrediant ADD CONSTRAINT FK_96856E478AEA29A FOREIGN KEY (ingrediant_id) REFERENCES ingrediant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE receipt DROP FOREIGN KEY FK_5399B645F7A369DD');
        $this->addSql('DROP INDEX IDX_5399B645F7A369DD ON receipt');
        $this->addSql('ALTER TABLE receipt DROP ingrediants_id, DROP picture, CHANGE name name VARCHAR(100) NOT NULL, CHANGE description description VARCHAR(100) NOT NULL, CHANGE instruction instruction VARCHAR(100) NOT NULL, CHANGE preparation preparation VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE share CHANGE recipient recipient VARCHAR(255) NOT NULL, CHANGE subject subject VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE is_active is_active TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE receipt_ingrediant');
        $this->addSql('ALTER TABLE receipt ADD ingrediants_id INT NOT NULL, ADD picture VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE instruction instruction VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE preparation preparation VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE receipt ADD CONSTRAINT FK_5399B645F7A369DD FOREIGN KEY (ingrediants_id) REFERENCES ingrediant (id)');
        $this->addSql('CREATE INDEX IDX_5399B645F7A369DD ON receipt (ingrediants_id)');
        $this->addSql('ALTER TABLE share CHANGE recipient recipient VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'Hello friend i share you this receipt from receipt-manager.com\' NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE subject subject VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'Receipt Manager\' NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE is_active is_active TINYINT(1) DEFAULT NULL');
    }
}
