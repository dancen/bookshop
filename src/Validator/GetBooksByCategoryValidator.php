<?php

namespace App\Validator;

use App\Validator\AppValidator;
use App\Model\AppInterface;

/**
 * @Annotation
 */
class GetBooksByCategoryValidator extends AppValidator implements AppInterface {

    private $violations = array();
    
    private $validator;
    
    public function validate($params) {

        $sanitized_params = $this->getSanitizedParams($params);        

        
        if ($sanitized_params[self::CATEGORY_NAME] == "") {
            $message = array( self::CATEGORY_NAME => array(
               "code" => "error_author",
               "message" => "parameter 'author' cannot be blank"
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
