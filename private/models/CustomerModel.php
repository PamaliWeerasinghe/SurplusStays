<?php

class CustomerModel extends Model
{
    public $table;
    public $errors = array();
    public $data=array();
    public $column;
    
    protected $db;


    public function __construct()
    {
         if (!property_exists($this, 'table')) {
              $this->table = strtolower($this::class);
         }
         $this->db=Database::getInstance();

    }


    public function validateEdit($DATA)
    {
        // Validation rules
        $this->errors = []; // Reset errors

        if(empty($DATA['fname'])) {
            $this->errors['fname'] = "First name is required";
        }
        if(empty($DATA['lname'])) {
            $this->errors['lname'] = "Last name is required";
        }
        if(empty($DATA['email'])) {
            $this->errors['email'] = "Email name is required";
        }
        if(empty($DATA['phone']) || !is_numeric($DATA['phone'])) {
            $this->errors['phone'] = "A valid phone number is required";
        }
        if(empty($DATA['username'])) {
            $this->errors['username'] = "Username is required";
        }

        // Return true if no errors
        return empty($this->errors);
    }
  

    
}