<?php

class Business extends Model
{
    protected $table = "business";

    protected $beforeInsert=[
        'hash_password'
    ];

    public function validate($DATA)
    {
        // Validation rules
        $this->errors = []; // Reset errors
        if(empty($DATA['name'])) {
            $this->errors['name'] = "Business name is required";
        }

        $types=['Individual','Smallbusiness','Supermarket','Other'];
        if(empty($DATA['type']) || !in_array($DATA['type'],$types)) {
            $this->errors['type'] = "Business type cannot be empty";
        }
        if(!filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "A valid email is required";
        }

        //check if email exists
        if($this->where('email',$DATA['email'])) {
            $this->errors['email'] = "Email is already in use";
        }
        if(empty($DATA['phone']) || !is_numeric($DATA['phone'])) {
            $this->errors['phone'] = "A valid phone number is required";
        }
        if(empty($DATA['address'])) {
            $this->errors['address'] = "address is required";
        }

        if (empty($DATA['picture'])) {
            $this->errors['picture'] = "Profile picture is required";
        }
        
        if(empty($DATA['username'])) {
            $this->errors['username'] = "Username is required";
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

    public function hash_password($data){
        $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);
        return $data;
    }
}