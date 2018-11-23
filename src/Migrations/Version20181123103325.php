<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181123103325 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book CHANGE author_id author_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE books_categories DROP FOREIGN KEY FK_16746F1512469DE2');
        $this->addSql('ALTER TABLE books_categories DROP FOREIGN KEY FK_16746F1516A2B381');
        $this->addSql('ALTER TABLE books_categories ADD CONSTRAINT FK_16746F1512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE books_categories ADD CONSTRAINT FK_16746F1516A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE borrow CHANGE book_id book_id BIGINT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE box_from_id box_from_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book CHANGE author_id author_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE books_categories DROP FOREIGN KEY FK_16746F1516A2B381');
        $this->addSql('ALTER TABLE books_categories DROP FOREIGN KEY FK_16746F1512469DE2');
        $this->addSql('ALTER TABLE books_categories ADD CONSTRAINT FK_16746F1516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE books_categories ADD CONSTRAINT FK_16746F1512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE borrow CHANGE book_id book_id BIGINT NOT NULL, CHANGE box_from_id box_from_id BIGINT NOT NULL, CHANGE user_id user_id BIGINT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user DROP firstname, DROP lastname, DROP email, DROP roles, DROP password, CHANGE id id BIGINT AUTO_INCREMENT NOT NULL');
    }
}
