<?php

class Donation extends Model
{
    protected $table = "donations";

    public function validate($DATA)
    {
        // Validation rules
        $this->errors = []; // Reset errors

        if(empty($DATA['title'])) {
            $this->errors['title'] = "A title for the message is required";
        }
        if(empty($DATA['message'])) {
            $this->errors['message'] = "Please enter your message";
        }
        
        // Return true if no errors
        return empty($this->errors);
    }

    
}
