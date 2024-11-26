<?php

class AdminModel extends Admin_Model
{

    public $table = 'organization';

    //Validate Admin login details
    public function validate($DATA)
    {
        $this->errors = array();
        //validating the name
        // if (!preg_match('/^[a-z A-Z]+$/', $DATA['fullName'])) {
        //     $this->errors['name'] = "Only letters are allowed for the full name";
        // }

        //validating the email
        if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        }
        //validating the password
        if (empty($DATA['password'])) {
            $this->errors['password'] = "Password is empty";
        }


        //No errors
        if (count($this->errors) == 0) {
            return true;
        }
        //Contains errors
        return false;
    }
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
    public function uploadLogo($logo)
    {

        $logoExt = explode('.', $logo);
        $logoActualExt = strtolower(end($logoExt));
        $logoNameNew = uniqid('', true) . "." . $logoActualExt;
        $fileDestination = '../../SurplusStays/public/assets/uploads/' . $logoNameNew;
        $dbFileDestination = '../../../SurplusStays/public/assets/uploads/' . $logoNameNew;
        move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination);

        return $dbFileDestination;
    }

    public function validateEditCharity($DATA)
    {
        $this->errors = array();
        $this->data = array();

        if (!empty($DATA['name'])) {
        
            if (!preg_match('/^[a-z A-Z &]+$/', $DATA['name'])) {
                
                $this->errors['name'] = "Only letters are allowed for the name";
            } else {
            
                $this->data['name'] = $DATA['name'];
                
            }
        }
        $logo = $_FILES['file']['name'];
        print_r($logo);
        $logoExt = explode('.', $logo);
        $logoActualExt = strtolower(end($logoExt));
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($logoActualExt, $allowed)) {
            if ($_FILES['file']['error'] != 0) {
                $this->errors['logo'] = "There was an error uploading your file!";
            } else if (!in_array($logoActualExt, $allowed)) {
                $this->errors['logo'] = "You cannot upload files of this type!";
            } else {
                $editCharity = new AdminModel();
                $this->data['picture'] = $editCharity->uploadLogo($logo);
            }
        }

        if (!empty($DATA['city'])) {
            if (!preg_match('/^[a-z A-Z]+$/', $DATA['city'])) {
                $this->errors['city'] = "Only letters are allowed for the city";
            } else {
                $this->data['city'] = $DATA['city'];
            }
        }

        if (!empty($DATA['email'])) {
            if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "Email is not valid";
            } else {
                $this->data['email'] = $DATA['email'];
            }
        }

        if (!empty($DATA['phone'])) {
            if (!preg_match('/^(\+94|0)?((7|1)[0-9]{1})[0-9]{7}$/', $DATA['phone'])) {
                $this->errors['phone'] = "Invalid phone number";
            } else {
                $this->data['phoneNo'] = $DATA['phone'];
            }
        }

        if (!empty($DATA['description'])) {
            $this->data['charity_description'] = $DATA['description'];
        }

        if (!empty($DATA['username'])) {
            $this->data['username'] = $DATA['username'];
        }

        if (!empty($DATA['password']) || !empty($DATA['confirm_password'])) {
            if ($DATA['password'] != $DATA['confirm_password']) {
                $this->errors['password'] = "Passwords does not match";
            } else {
                $this->data['password'] = $DATA['password'];
                
            }
        }

        if (count($this->errors) == 0) {
            return true;
        } else {
            return false;
        }
    }
}
