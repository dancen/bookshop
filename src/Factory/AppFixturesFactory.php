<?php

namespace App\Factory;

use App\DataFixtures\AppFixtures;

/**
 * Description of AppFixturesFactory
 *
 * @author dan
 */
class AppFixturesFactory {
    
    public static function create(){
        return new AppFixtures();
    }
}