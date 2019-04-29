<?php

namespace App\Model;

use App\Model\AppInterface;

/**
 *
 * BookshopInterface
 */
interface BookshopInterface extends AppInterface {

    
    
    /**
     * Lists Books by Author.
     *
     * @return json
     */
    public function getBooksByAuthor($params);

    
    
    
    /**
     * Lists Books by category.
     *
     * @return json
     */
    public function getBooksByCategory($params);

    
    
    /**
     * create a new Book.
     *
     * @return Book
     */
    public function createBook($params);
    
    
    /**
     * get category by name
     *
     * @return Book
     */
    public function getCategoryByName($params);
    
    /**
     * get all categories
     *
     * @return Book
     */
    public function getCategories();
    
    
    /**
     * Lists Books by Author and Category
     *
     * @return Book
     */
    public function getBooksByAuthorAndCategory($params);
    
}
