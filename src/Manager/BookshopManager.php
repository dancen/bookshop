<?php

namespace App\Manager;

use App\Manager\AppManager;
use App\Model\BookshopInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;
use App\Factory\BookFactory;
use App\Entity\Category;
use App\Factory\CategoryFactory;
use JMS\Serializer\SerializerBuilder;

/**
 * Description of ApiGroupManager
 *
 * @author dan
 */
class BookshopManager extends AppManager implements BookshopInterface {

    /**
     * Returns 
     *
     * @param  
     * @return 
     */
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * getBooksByAuthor
     *
     * @return json
     */
    public function getBooksByAuthor($params_data) {

        $author = $params_data[BookshopInterface::AUTHOR];

        return $this->em->getRepository(Book::class)->getBooksByAuthor($author);
    }

    /**
     * getBooksByCategory
     *
     * @return json
     */
    public function getBooksByCategory($params_data) {

        $name = $params_data[BookshopInterface::CATEGORY_NAME];

        return $this->em->getRepository(Book::class)->getBooksByCategory($name);
    }

    /**
     * ccreateBook
     *
     * @return Book
     */
    public function createBook($params_data) {

        $isbn = $params_data[BookshopInterface::ISBN];
        $title = $params_data[BookshopInterface::TITLE];
        $author = $params_data[BookshopInterface::AUTHOR];
        $price = $params_data[BookshopInterface::PRICE];

        $category = $this->getCategoryByNameObj($params_data);

        if (!$category) {

            $name = $params_data[BookshopInterface::CATEGORY_NAME];
            $category = CategoryFactory::create();
            $category->setName($name);
            $this->em->persist($category);
            $this->em->flush();
        }

        $book = BookFactory::create();
        $book->setIsbn($isbn);
        $book->setTitle($title);
        $book->setAuthor($author);
        $book->setPrice($price);
        $book->setCategory($category);
        $this->em->persist($book);
        $this->em->flush();

        $serializer = SerializerBuilder::create()->build();
        $array = $serializer->toArray($book);

        return $array;
    }

    /**
     * get getCategoryByName.
     *
     * @return Category
     */
    public function getCategoryByName($params_data) {

        $name = $params_data[BookshopInterface::CATEGORY_NAME];

        return $this->em->getRepository(Category::class)->getCategoryByName($name);
    }

    /**
     * get getCategoryByNameObj.
     *
     * @return Category
     */
    public function getCategoryByNameObj($params_data) {

        $name = $params_data[BookshopInterface::CATEGORY_NAME];

        return $this->em->getRepository(Category::class)->findOneBy(array("name" => $name));
    }

    /**
     * get getCategories.
     *
     * @return Category
     */
    public function getCategories() {

        return $this->em->getRepository(Category::class)->getCategories();
    }

    /**
     * getBooksByAuthorAndCategory
     *
     * @return json
     */
    public function getBooksByAuthorAndCategory($params_data) {

        $author = $params_data[BookshopInterface::AUTHOR];
        $category = $params_data[BookshopInterface::CATEGORY_NAME];

        return $this->em->getRepository(Book::class)->getBooksByAuthorAndCategory($author, $category);
    }

}
