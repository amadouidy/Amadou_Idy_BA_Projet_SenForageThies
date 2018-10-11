<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181007182424 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_351268BB19EB6921 ON abonnement (client_id)');
        $this->addSql('ALTER TABLE client ADD village_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404555E0D5582 FOREIGN KEY (village_id) REFERENCES village (id)');
        $this->addSql('CREATE INDEX IDX_C74404555E0D5582 ON client (village_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB19EB6921');
        $this->addSql('DROP INDEX IDX_351268BB19EB6921 ON abonnement');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404555E0D5582');
        $this->addSql('DROP INDEX IDX_C74404555E0D5582 ON client');
        $this->addSql('ALTER TABLE client DROP village_id');
    }
}
