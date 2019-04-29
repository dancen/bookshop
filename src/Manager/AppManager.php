<?php

namespace App\Manager;



/**
 * App\Manager\AppManager
 *
 * @author dan
 */
abstract class AppManager {

       
    // $em
    protected $em;
 
       
        
    /**
     * Returns the entity repository
     *
     * @param  String 
     * @return EntityRepository 
     */
    protected function getRepo( $class ) {
        return $this->em->getRepository( $class );
    }
    
   

}
