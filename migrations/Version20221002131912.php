<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221002131912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $now = strtotime('now');
        $oneYearAgo = strtotime("- 365 days");
        // echo date('d.m.Y H:i:s', $oneYearAgo);
        $date1 = date('Y-m-d H:i:s', rand($now, $oneYearAgo));
        $date2 = date('Y-m-d H:i:s', rand($now, $oneYearAgo));
        $date3 = date('Y-m-d H:i:s', rand($now, $oneYearAgo));

        //this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, conference_id INT DEFAULT NULL, author VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9474526C604B8382 (conference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE conference (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, year INT NOT NULL, international TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C604B8382 FOREIGN KEY (conference_id) REFERENCES conference (id)');

        //inserting some rows for conference
        $this->addSql('INSERT INTO conference (city, title, year, international) VALUES("Wien", "Agile Vienna", 2022, 1)');
        $this->addSql('INSERT INTO conference (city, title, year, international) VALUES("London", "JAX London Hybrid Conference", 2021, 0)');
        $this->addSql('INSERT INTO conference (city, title, year, international) VALUES("Edinburgh", "FYNE CONF - Golang", 2022, 1)');


        // inserting some comments for each of the conferences
        $this->addSql('INSERT INTO comment (conference_id, author, content, email, created_at) VALUES(1, "John", "Awesome", "john@web.com", "' . $date1 . '")');
        $this->addSql('INSERT INTO comment (conference_id, author, content, email, created_at) VALUES(1, "Peter", "Super cool", "peter@gmail.com", "' . $date2 . '")');
        $this->addSql('INSERT INTO comment (conference_id, author, content, email, created_at) VALUES(1, "Bob", "Very informative", "bobby@gmail.com", "' . $date3 . '")');


        $this->addSql('INSERT INTO comment (conference_id, author, content, email, created_at) VALUES(2, "Jane", "Impressive", "jane@gmail.com", "' . $date3 . '")');
        $this->addSql('INSERT INTO comment (conference_id, author, content, email, created_at) VALUES(2, "Janette", "That was fun", "janette@gmail.com", "' . $date2 . '")');
        $this->addSql('INSERT INTO comment (conference_id, author, content, email, created_at) VALUES(2, "Jaqueline", "Did I forget to turn off the iron?", "jaqueline@gmail.com", "' . $date1 . '")');


        $this->addSql('INSERT INTO comment (conference_id, author, content, email, created_at) VALUES(3, "Thomas", "Looking forward to the next event", "thomas@gmail.com", "' . $date1 . '")');
        $this->addSql('INSERT INTO comment (conference_id, author, content, email, created_at) VALUES(3, "Thorsten", "Cant wait!", "thorsten@gmail.com", "' . $date2 . '")');
        $this->addSql('INSERT INTO comment (conference_id, author, content, email, created_at) VALUES(3, "Steffanie", "Thats the big show", "steffanie@gmail.com", "' . $date3 . '")');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C604B8382');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE conference');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
