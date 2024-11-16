<?php 

class User extends Model{
    protected $table='admin';

    //Validate Admin login details
    public function validate($DATA){
        $this->errors=array();
        //validating the name
        if(!preg_match('/^[a-z A-Z]+$/',$DATA['fullName'])){
            $this->errors[0]="Only letters are allowed for the full name";
        }

        //validating the email
        if(empty($DATA['email'])|| !filter_var($DATA['email'],FILTER_VALIDATE_EMAIL)){
            $this->errors[1]="Email is not valid";
        }
        

        //No errors
        if(count($this->errors)==0){
            return true;
        }
        //Contains errors
        return false;
        
    
    }


}





?>