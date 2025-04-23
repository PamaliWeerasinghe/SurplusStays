<?php

class BusinessChangePassword extends Model{

    public $table='user';

    protected $db;

    public function __construct()
    {
        $this->db=Database::getInstance();
    }

    public function validate($DATA, $userId){
        $this->errors=[];
    
        if(empty($DATA['current_password'])){
            $this->errors['current_password']='Current password field should not be empty';
        }
    
        $curruser = $this->where('id', $userId, 'user');
    
        if (!empty($DATA['current_password']) && !password_verify($DATA['current_password'], $curruser[0]->password)) {
            $this->errors['current_password'] = "Current password is not matched";
        }
    
        if (empty($DATA['password']) || strlen($DATA['password']) < 6) {
            $this->errors['password'] = "Password must be at least 6 characters";
        }
        if ($DATA['password'] !== $DATA['confirm_password']) {
            $this->errors['confirm_password'] = "Passwords do not match";
        }
    
        return empty($this->errors);
    }
    
    
}


?>