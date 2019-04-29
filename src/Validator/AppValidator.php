<?php

namespace App\Validator;

/**
 *
 * @author dan
 */
abstract class AppValidator {
    
   abstract public function validate( $params );
   
   abstract public function addViolation( $message );  
   
   abstract public function getErrors();
   
   protected function getSanitizedParams($params) {

        $sanitized = array();
        foreach ($params as $key => $param) {
            if (is_string($param) === true) {
                $param = strip_tags(escapeshellcmd($param));
            }
            $sanitized[$key] = $param;
        }
        return $sanitized;
    }
    
   
   
}
