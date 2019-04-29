<?php

namespace App\Validator;

use App\Validator\AppValidator;
use App\Model\AppInterface;

/**
 * @Annotation
 */
class CreateBookValidator extends AppValidator implements AppInterface {

    private $violations = array();
    
    private $validator;
    
    public function validate($params) {

        $sanitized_params = $this->getSanitizedParams($params);        

        
        if ($sanitized_params[self::CATEGORY_NAME] == "") {
            $message = array( self::CATEGORY_NAME => array(
               "code" => "error_category",
               "message" => "parameter 'category' cannot be blank"
            ));
            $this->addViolation($message); 
            
        }
        
        if (($sanitized_params[self::ISBN] == "") ||
             !preg_match("/[0-9]{3}+[-]{1}+[0-9]{9}/", $sanitized_params[self::ISBN])){
            $message = array( self::ISBN => array(
               "code" => "error_isbn",
               "message" => "Invalid ISBN"
            ));
            $this->addViolation($message); 
            
        }
        
        if ($sanitized_params[self::TITLE] == "") {
            $message = array( self::TITLE => array(
               "code" => "error_title",
               "message" => "parameter 'title' cannot be blank"
            ));
            $this->addViolation($message); 
            
        }
        
        if ($sanitized_params[self::AUTHOR] == "") {
            $message = array( self::AUTHOR => array(
               "code" => "error_author",
               "message" => "parameter 'author' cannot be blank"
            ));
            $this->addViolation($message); 
            
        }
        
        if ($sanitized_params[self::PRICE] == "") {
            $message = array( self::PRICE => array(
               "code" => "error_price",
               "message" => "parameter 'price' cannot be blank"
            ));
            $this->addViolation($message); 
            
        }
        
       

        return $this;
    }

    public function addViolation($message) {
        array_push($this->violations, $message);
    }

    public function getSanitizedParams($params) {
        return parent::getSanitizedParams($params);
    }

    public function getErrors() {
        return $this->violations;
    }
    
    public function setValidator($validator) {
        $this->validator = $validator;
    }
    
    
   

}
