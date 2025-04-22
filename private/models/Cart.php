<?php
class Cart extends Model {

    public $table = 'cart';

    public function validate($DATA)
    {
        // Validation rules
        $this->errors = []; // Reset errors

        if(empty($DATA['qty'])) {
            $this->errors['qty'] = "A valid number for the quantity is required";
        }
        
        // Return true if no errors
        return empty($this->errors);
    }
}