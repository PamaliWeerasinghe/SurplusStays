<?php

class BusinessEditProfile extends Model
{
    public $table = "business";

    public function validate($DATA)
    {
        // Validation rules
        $this->errors = []; // Reset errors
        if (empty($DATA['name'])) {
            $this->errors['name'] = "Business name is required";
        }

        $types = ['Individual', 'Smallbusiness', 'Supermarket', 'Other'];
        if (empty($DATA['type']) || !in_array($DATA['type'], $types)) {
            $this->errors['type'] = "Business type cannot be empty";
        }
        
        if (empty($DATA['phone']) || !is_numeric($DATA['phone'])) {
            $this->errors['phone'] = "A valid phone number is required";
        }

        if (empty($DATA['username'])) {
            $this->errors['username'] = "Username is required";
        }
       
        
        // Return true if no errors
        return empty($this->errors);
    }

    
}
