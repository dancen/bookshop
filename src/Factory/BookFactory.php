<?php

namespace App\Factory;

use App\Entity\Book;

/**
 * Description of BookFactory
 *
 * @author dan
 */
class BookFactory {
    
    public static function create(){
        return new Book();
    }
}