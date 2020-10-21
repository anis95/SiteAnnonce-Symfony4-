<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181229191642 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce ADD categories_id INT DEFAULT NULL, ADD region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E598260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5A21214B7 ON annonce (categories_id)');
        $this->addSql('CREATE INDEX IDX_F65593E598260155 ON annonce (region_id)');
        $this->addSql('ALTER TABLE region ADD pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_F62F176A6E44244 ON region (pays_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5A21214B7');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E598260155');
        $this->addSql('DROP INDEX IDX_F65593E5A21214B7 ON annonce');
        $this->addSql('DROP INDEX IDX_F65593E598260155 ON annonce');
        $this->addSql('ALTER TABLE annonce DROP categories_id, DROP region_id');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F176A6E44244');
        $this->addSql('DROP INDEX IDX_F62F176A6E44244 ON region');
        $this->addSql('ALTER TABLE region DROP pays_id');
    }
}
