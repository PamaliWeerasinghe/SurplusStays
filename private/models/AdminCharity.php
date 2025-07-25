<?php 

class AdminCharity extends AdminModel
{
    

   
    //Validate charity org before inserting
    public function validateCharity($DATA)
    {
        $this->errors = array();
        //validate the name
        if (!preg_match('/^[a-z A-Z &]+$/', $DATA['name'])) {
            $this->errors['name'] = "Only letters are allowed for the name";
        }
        //validate the image selection

        $logo = $_FILES['logo']['name'];
        $logoExt = explode('.', $logo);
        $logoActualExt = strtolower(end($logoExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($logoActualExt, $allowed)) {
            if ($_FILES['logo']['error'] != 0) {
                $this->errors['logo'] = "There was an error uploading your file!";
            }
        } else {
            $this->errors['logo'] = "You cannot upload files of this type!";
        }

        if (isset($DATA['logo'])) {
            $this->errors['logo'] = "Select a logo for the Organization";
        }
        //validate the city
        if (!preg_match('/^[a-z A-Z]+$/', $DATA['city'])) {
            $this->errors['city'] = "Only letters are allowed for the city";
        }
        //validate the email
        if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        }
        //validate the mobile phone number
        if (!preg_match('/^(\+94|0)?((7|1)[0-9]{1})[0-9]{7}$/', $DATA['phone'])) {
            $this->errors['phone'] = "Invalid phone number";
        }
        //validate the organization description
        if (empty($DATA['description'])) {
            $this->errors['description'] = "Description cannot be empty";
        }
        //validate the username
        if (empty($DATA['username'])) {
            $this->errors['username'] = "Username should not be empty";
        }
        //validate passowrd01 and confirm_password
        if (empty($DATA['password'])) {
            $this->errors['password'] = "Password cannot be empty";
        } else if (empty($DATA['confirm_password'])) {
            $this->errors['password'] = "Confirm Password cannot be empty";
        } else {
            if ($DATA['password'] != $DATA['confirm_password']) {
                $this->errors['passwords'] = "Passwords do not match";
            }
        }


        if (count($this->errors) == 0) {
            return true;
        } else {
            return false;
        }
    }
   
}






?>