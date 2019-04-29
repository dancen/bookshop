<?php

namespace App\Factory;

use App\Entity\Category;

/**
 * Description of CategoryFactory
 *
 * @author dan
 */
class CategoryFactory {
    
    public static function create(){
        return new Category();
    }
}