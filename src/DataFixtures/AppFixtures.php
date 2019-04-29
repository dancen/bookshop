<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use App\Entity\Book;
use App\Factory\BookFactory;
use App\Factory\CategoryFactory;

/**
 * Description of AppFixtures
 *
 * @author dan
 */
class AppFixtures extends Fixture implements ORMFixtureInterface {

    public function load(ObjectManager $manager) {

        $connection = $manager->getConnection();
        $connection->exec("SET FOREIGN_KEY_CHECKS = 0;");
        $connection->exec("TRUNCATE bookshop_book");
        $connection->exec("TRUNCATE bookshop_category");
        $connection->exec("ALTER TABLE bookshop_book AUTO_INCREMENT = 1;");
        $connection->exec("ALTER TABLE bookshop_category AUTO_INCREMENT = 1;");
        $connection->exec("SET FOREIGN_KEY_CHECKS = 1;");

        $category1 = CategoryFactory::create();
        $category1->setName("PHP, Javascript");
        $manager->persist($category1);
        $manager->flush();

        $category2 = CategoryFactory::create();
        $category2->setName("Linux");
        $manager->persist($category2);
        $manager->flush();

        $category3 = CategoryFactory::create();
        $category3->setName("Javascript");
        $manager->persist($category3);
        $manager->flush();

        $book1 = BookFactory::create();
        $book1->setIsbn("978-1491918661");
        $book1->setTitle("Learning PHP, MySQL and Javascript: with jQuery, CSS & HTML5");
        $book1->setAuthor("Robin Nixon");
        $book1->setPrice(9.99);
        $book1->setCategory($category1);
        $manager->persist($book1);
        $manager->flush();

        $book2 = BookFactory::create();
        $book2->setIsbn("978-0596804848");
        $book2->setTitle("Ubuntu: Up and running: A power user's desktop guide");
        $book2->setAuthor("Robin Nixon");
        $book2->setPrice(12.99);
        $book2->setCategory($category2);
        $manager->persist($book2);
        $manager->flush();

        $book3 = BookFactory::create();
        $book3->setIsbn("978-1118999875");
        $book3->setTitle("Linux Bible");
        $book3->setAuthor("Christopher Negus");
        $book3->setPrice(19.99);
        $book3->setCategory($category2);
        $manager->persist($book3);
        $manager->flush();

        $book4 = BookFactory::create();
        $book4->setIsbn("978-1118999875");
        $book4->setTitle("Javascript: The Good Parts");
        $book4->setAuthor("Douglas Crockford");
        $book4->setPrice(8.99);
        $book4->setCategory($category3);
        $manager->persist($book4);
        $manager->flush();

        $books = $manager->getRepository(Book::class)->findBy(array("author" => "Josh Lockhart"));
        if (count($books) > 0) {
            foreach ($books as $book) {
                $manager->remove($book);
                $manager->flush();
            }
        }
    }

}
