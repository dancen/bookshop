<?php

namespace App\Validator;

use App\Validator\AppValidator;
use App\Model\AppInterface;

/**
 * @Annotation
 */
class GetCategoriesValidator extends AppValidator implements AppInterface {

    private $violations = array();
    
    private $validator;
    
    public function validate($params) {

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
