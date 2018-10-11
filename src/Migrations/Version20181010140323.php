<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181010140323 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compteur DROP FOREIGN KEY FK_4D021BD57F2DEE08');
        $this->addSql('DROP INDEX UNIQ_4D021BD57F2DEE08 ON compteur');
        $this->addSql('ALTER TABLE compteur DROP facture_id');
        $this->addSql('ALTER TABLE facture ADD compteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410AA3B9810 FOREIGN KEY (compteur_id) REFERENCES compteur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE866410AA3B9810 ON facture (compteur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compteur ADD facture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compteur ADD CONSTRAINT FK_4D021BD57F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4D021BD57F2DEE08 ON compteur (facture_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410AA3B9810');
        $this->addSql('DROP INDEX UNIQ_FE866410AA3B9810 ON facture');
        $this->addSql('ALTER TABLE facture DROP compteur_id');
    }
}
