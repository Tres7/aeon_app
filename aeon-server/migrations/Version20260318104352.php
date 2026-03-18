<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260318104352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte_partie (carte_id INT NOT NULL, partie_id INT NOT NULL, INDEX IDX_137F7F0CC9C7CEB6 (carte_id), INDEX IDX_137F7F0CE075F7A4 (partie_id), PRIMARY KEY (carte_id, partie_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE fusion_carte (carte_id INT NOT NULL, fusion_id INT NOT NULL, INDEX IDX_8D1DCF3FC9C7CEB6 (carte_id), INDEX IDX_8D1DCF3F86209BDE (fusion_id), PRIMARY KEY (carte_id, fusion_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE partie_personnage (partie_id INT NOT NULL, personnage_id INT NOT NULL, INDEX IDX_3CDAB6ECE075F7A4 (partie_id), INDEX IDX_3CDAB6EC5E315342 (personnage_id), PRIMARY KEY (partie_id, personnage_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tour_joueur (tour_id INT NOT NULL, joueur_id INT NOT NULL, INDEX IDX_C8FF4E2F15ED8D43 (tour_id), INDEX IDX_C8FF4E2FA9E2D76C (joueur_id), PRIMARY KEY (tour_id, joueur_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE carte_partie ADD CONSTRAINT FK_137F7F0CC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carte_partie ADD CONSTRAINT FK_137F7F0CE075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fusion_carte ADD CONSTRAINT FK_8D1DCF3FC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fusion_carte ADD CONSTRAINT FK_8D1DCF3F86209BDE FOREIGN KEY (fusion_id) REFERENCES fusion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie_personnage ADD CONSTRAINT FK_3CDAB6ECE075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie_personnage ADD CONSTRAINT FK_3CDAB6EC5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tour_joueur ADD CONSTRAINT FK_C8FF4E2F15ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tour_joueur ADD CONSTRAINT FK_C8FF4E2FA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE action ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_action (id)');
        $this->addSql('CREATE INDEX IDX_47CC8C92BCF5E72D ON action (categorie_id)');
        $this->addSql('ALTER TABLE carte ADD action_id INT DEFAULT NULL, ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE carte ADD CONSTRAINT FK_BAD4FFFD9D32F035 FOREIGN KEY (action_id) REFERENCES action (id)');
        $this->addSql('ALTER TABLE carte ADD CONSTRAINT FK_BAD4FFFDBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_carte (id)');
        $this->addSql('CREATE INDEX IDX_BAD4FFFD9D32F035 ON carte (action_id)');
        $this->addSql('CREATE INDEX IDX_BAD4FFFDBCF5E72D ON carte (categorie_id)');
        $this->addSql('ALTER TABLE joueur ADD partie_id INT NOT NULL, ADD personnage_id INT NOT NULL');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C55E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('CREATE INDEX IDX_FD71A9C5E075F7A4 ON joueur (partie_id)');
        $this->addSql('CREATE INDEX IDX_FD71A9C55E315342 ON joueur (personnage_id)');
        $this->addSql('ALTER TABLE partie ADD extension_id INT NOT NULL');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D812D5EB FOREIGN KEY (extension_id) REFERENCES extension (id)');
        $this->addSql('CREATE INDEX IDX_59B1F3D812D5EB ON partie (extension_id)');
        $this->addSql('ALTER TABLE personnage_dialogue ADD action_id INT NOT NULL');
        $this->addSql('ALTER TABLE personnage_dialogue ADD CONSTRAINT FK_86A133979D32F035 FOREIGN KEY (action_id) REFERENCES action (id)');
        $this->addSql('CREATE INDEX IDX_86A133979D32F035 ON personnage_dialogue (action_id)');
        $this->addSql('ALTER TABLE tour ADD partie_id INT NOT NULL');
        $this->addSql('ALTER TABLE tour ADD CONSTRAINT FK_6AD1F969E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_6AD1F969E075F7A4 ON tour (partie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_partie DROP FOREIGN KEY FK_137F7F0CC9C7CEB6');
        $this->addSql('ALTER TABLE carte_partie DROP FOREIGN KEY FK_137F7F0CE075F7A4');
        $this->addSql('ALTER TABLE fusion_carte DROP FOREIGN KEY FK_8D1DCF3FC9C7CEB6');
        $this->addSql('ALTER TABLE fusion_carte DROP FOREIGN KEY FK_8D1DCF3F86209BDE');
        $this->addSql('ALTER TABLE partie_personnage DROP FOREIGN KEY FK_3CDAB6ECE075F7A4');
        $this->addSql('ALTER TABLE partie_personnage DROP FOREIGN KEY FK_3CDAB6EC5E315342');
        $this->addSql('ALTER TABLE tour_joueur DROP FOREIGN KEY FK_C8FF4E2F15ED8D43');
        $this->addSql('ALTER TABLE tour_joueur DROP FOREIGN KEY FK_C8FF4E2FA9E2D76C');
        $this->addSql('DROP TABLE carte_partie');
        $this->addSql('DROP TABLE fusion_carte');
        $this->addSql('DROP TABLE partie_personnage');
        $this->addSql('DROP TABLE tour_joueur');
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C92BCF5E72D');
        $this->addSql('DROP INDEX IDX_47CC8C92BCF5E72D ON action');
        $this->addSql('ALTER TABLE action DROP categorie_id');
        $this->addSql('ALTER TABLE carte DROP FOREIGN KEY FK_BAD4FFFD9D32F035');
        $this->addSql('ALTER TABLE carte DROP FOREIGN KEY FK_BAD4FFFDBCF5E72D');
        $this->addSql('DROP INDEX IDX_BAD4FFFD9D32F035 ON carte');
        $this->addSql('DROP INDEX IDX_BAD4FFFDBCF5E72D ON carte');
        $this->addSql('ALTER TABLE carte DROP action_id, DROP categorie_id');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5E075F7A4');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C55E315342');
        $this->addSql('DROP INDEX IDX_FD71A9C5E075F7A4 ON joueur');
        $this->addSql('DROP INDEX IDX_FD71A9C55E315342 ON joueur');
        $this->addSql('ALTER TABLE joueur DROP partie_id, DROP personnage_id');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D812D5EB');
        $this->addSql('DROP INDEX IDX_59B1F3D812D5EB ON partie');
        $this->addSql('ALTER TABLE partie DROP extension_id');
        $this->addSql('ALTER TABLE personnage_dialogue DROP FOREIGN KEY FK_86A133979D32F035');
        $this->addSql('DROP INDEX IDX_86A133979D32F035 ON personnage_dialogue');
        $this->addSql('ALTER TABLE personnage_dialogue DROP action_id');
        $this->addSql('ALTER TABLE tour DROP FOREIGN KEY FK_6AD1F969E075F7A4');
        $this->addSql('DROP INDEX IDX_6AD1F969E075F7A4 ON tour');
        $this->addSql('ALTER TABLE tour DROP partie_id');
    }
}
