<?php

class Customer extends Model
{
    public $table = "customer";

    public function validate($DATA)
    {
        // Validation rules
        $this->errors = []; // Reset errors

        if(empty($DATA['fname'])) {
            $this->errors['fname'] = "Your first name is required";
        }
        if(empty($DATA['lname'])) {
            $this->errors['lname'] = "Your last name is required";
        }
        if(!filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "A valid email is required";
        }
        //check if email exists
        if($this->where('email',$DATA['email'],'customer')) {
            $this->errors['email'] = "Email is already in use";
        }
        if(empty($DATA['phone']) || !is_numeric($DATA['phone'])) {
            $this->errors['phone'] = "A valid phone number is required";
        }
        if(empty($DATA['username'])) {
            $this->errors['username'] = "A Username is required";
        }
        if (empty($DATA['picture'])) {
            $this->errors['picture'] = "A Profile picture is required";
        }
        if(empty($DATA['password']) || strlen($DATA['password']) < 6) {
            $this->errors['password'] = "Password must be at least 6 characters";
        }
        if($DATA['password'] !== $DATA['confirm_password']) {
            $this->errors['confirm_password'] = "Passwords do not match";
        }

        // Return true if no errors
        return empty($this->errors);
    }
}
