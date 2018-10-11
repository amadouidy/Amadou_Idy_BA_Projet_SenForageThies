<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180922134151 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compteur ADD abonnement_id INT NOT NULL');
        $this->addSql('ALTER TABLE compteur ADD CONSTRAINT FK_4D021BD5F1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id)');
        $this->addSql('CREATE INDEX IDX_4D021BD5F1D74413 ON compteur (abonnement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compteur DROP FOREIGN KEY FK_4D021BD5F1D74413');
        $this->addSql('DROP INDEX IDX_4D021BD5F1D74413 ON compteur');
        $this->addSql('ALTER TABLE compteur DROP abonnement_id');
    }
}
