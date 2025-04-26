<?php

class AdminModel extends Admin_Model
{
    public function insertCharity($user_columns,$user_values,$charity_columns,$charity_values,$user,$charity)
    {
        try {
        
            if(!$this->where(['email'],[$user_values[0]],'user') ){
               
                        //begin the transaction
                    $this->db->beginTransaction();
                    
                    //insert the user
                    if($this->insert($user,'user')){
                        
                        $this->db->rollback();
                        return false;
                    }
                    
                    //get the last id
                    $id=$this->db->lastInsertId();
                    
                    //Insert into organization table
                    $charity['user_id']=$id;
                    if($this->insert($charity,'organization')){
                        $this->db->rollback();
                        return false;
                    }
                    //commit the transaction
                    $this->db->commit();
                    return true;
              
               
            }else{
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
     //upload charity organization logo
     public function uploadCharityOrgPic($logo)
     {
 
         $logoExt = explode('.', $logo);
         $logoActualExt = strtolower(end($logoExt));
         $logoNameNew = uniqid('', true) . "." . $logoActualExt;
         $fileDestination =$_SERVER['DOCUMENT_ROOT'] .'/SurplusStays/public/assets/charityImages/' . $logoNameNew;
         $dbFileDestination = $logoNameNew;
         move_uploaded_file($_FILES['profile_picture']['tmp_name'], $fileDestination);
 
         return $dbFileDestination;
     }
     //validate Edit Customer
     public function validateEditCustomer($DATA)
     {
         $this->errors = array();
         $this->data = array();
 
         if (!empty($DATA['fname'])) {
         
             if (!preg_match('/^[a-z A-Z &]+$/', $DATA['fname'])) {
                 
                 $this->errors['fname'] = "Only letters are allowed for the first name";
             } else {
             
                 $this->data['fname'] = $DATA['fname'];
                 
             }
         }
         if (!empty($DATA['lname'])) {
         
            if (!preg_match('/^[a-z A-Z &]+$/', $DATA['lname'])) {
                
                $this->errors['lname'] = "Only letters are allowed for the first name";
            } else {
            
                $this->data['lname'] = $DATA['lname'];
                
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
        if (!empty($DATA['username'])) {
            $this->data['username'] = $DATA['username'];
        }

         $logo = $_FILES['profile_picture']['name'];
         
         $logoExt = explode('.', $logo);
         $logoActualExt = strtolower(end($logoExt));
         $allowed = array('jpg', 'jpeg', 'png');
 
         if (in_array($logoActualExt, $allowed)) {
             if ($_FILES['profile_picture']['error'] != 0) {
                 $this->errors['profile_pic'] = "There was an error uploading your file!";
             } else if (!in_array($logoActualExt, $allowed)) {
                 $this->errors['profile_pic'] = "You cannot upload files of this type!";
             } else {
                 $editCustomer = new AdminModel();
                 $this->data['profile_pic'] = $editCustomer->updateCustomerPic($logo);
             }
         }
         
 
         if (count($this->errors) == 0) {
             return true;
         } else {
             return false;
         }
     }
    //Validate Admin login details
    public function validate($DATA)
    {
        $this->errors = array();
      

        //validating the email
        if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        }
        //validate the name
        if (!preg_match('/^[a-z A-Z &]+$/', $DATA['fname'])) {
            $this->errors['name'] = "Only letters are allowed for the name";
        }
        //validating the password
        if (empty($DATA['password'])) {
            $this->errors['password'] = "Password is empty";
        }
          //validate the image selection
          $logo = $_FILES['profile_picture']['name'];
          $logoExt = explode('.', $logo);
          $logoActualExt = strtolower(end($logoExt));
          $allowed = array('jpg', 'jpeg', 'png');
          if (in_array($logoActualExt, $allowed)) {
              if ($_FILES['profile_picture']['error'] != 0) {
                  $this->errors['profile_picture'] = "There was an error uploading your profile picture!";
              }
          } else {
              $this->errors['profile_picture'] = "You cannot add images of this type!";
          }
  
          if (isset($DATA['profile_picture'])) {
              $this->errors['profile_picture'] = "Select a profile photo";
          }

        //No errors
        if (count($this->errors) == 0) {
            return true;
        }
        //Contains errors
        return false;
    }
    //Validate Admin Register details
    public function validateAdminRegister($DATA)
    {
        $this->errors = array();
      

        //validating the email
        if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        }
        //validating the password
        if (empty($DATA['password'])) {
            $this->errors['password'] = "Password is empty";
        }
        //validating the name
        if (!preg_match('/^[a-z A-Z &]+$/', $DATA['name'])) {
            $this->errors['name'] = "Only letters are allowed for the name";
        }
        
         if (!isset($_FILES['profile_pic'])) {

             $this->errors['profile_pic'] = "Select a profile photo";
         }else{
             //validate the image selection
            $logo = $_FILES['profile_pic']['name'];
            $logoExt = explode('.', $logo);
             $logoActualExt = strtolower(end($logoExt));
             $allowed = array('jpg', 'jpeg', 'png');
                if (in_array($logoActualExt, $allowed)) {
                    if ($_FILES['profile_pic']['error'] != 0) {
                        $this->errors['profile_pic'] = "There was an error uploading your profile picture!";
                    }
                } else {
                    $this->errors['profile_pic'] = "You cannot add images of this type!";
                }
 
         }
        

        //No errors
        if (count($this->errors) == 0) {
            return true;
        }
        //Contains errors
        return false;

    }
    //validate customer before inserting
    public function validateCustomer($DATA)
    {
        $this->errors=array();
        //validate fname and lname
        if (!preg_match('/^[a-z A-Z &]+$/', $DATA['fname'])) {
            $this->errors['fname'] = "Only letters are allowed for the first name";
        }
        if (!preg_match('/^[a-z A-Z &]+$/', $DATA['lname'])) {
            $this->errors['lname'] = "Only letters are allowed for the last name";
        }
         
         //validate the email
        if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        }

         //validate the mobile phone number
         if (!preg_match('/^(\+94|0)?((7|1)[0-9]{1})[0-9]{7}$/', $DATA['phone'])) {
            $this->errors['phone'] = "Invalid phone number";
        }

         //validate the username
         if (empty($DATA['username'])) {
            $this->errors['username'] = "Username should not be empty";
        }

         //validate the image selection
         $logo = $_FILES['profile_picture']['name'];
         $logoExt = explode('.', $logo);
         $logoActualExt = strtolower(end($logoExt));
         $allowed = array('jpg', 'jpeg', 'png');
         if (in_array($logoActualExt, $allowed)) {
             if ($_FILES['profile_picture']['error'] != 0) {
                 $this->errors['profile_picture'] = "There was an error uploading your profile picture!";
             }
         } else {
             $this->errors['profile_picture'] = "You cannot add images of this type!";
         }
 
         if (isset($DATA['profile_picture'])) {
             $this->errors['profile_picture'] = "Select a profile photo";
         }
        
        //validate passowrd and the confirm_password
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
    //Validate charity org before inserting
    public function validateCharity($DATA)
    {
        $this->errors = array();
        //validate the name
        if (!preg_match('/^[a-z A-Z &]+$/', $DATA['name'])) {
            $this->errors['name'] = "Only letters are allowed for the name";
        }
        //validate the image selection

        $logo = $_FILES['profile_picture']['name'];
        $logoExt = explode('.', $logo);
        $logoActualExt = strtolower(end($logoExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($logoActualExt, $allowed)) {
            if ($_FILES['profile_picture']['error'] != 0) {
                $this->errors['logo'] = "There was an error uploading your file!";
            }
        } else {
            $this->errors['logo'] = "You cannot upload files of this type!";
        }

        if (isset($DATA['profile_picture'])) {
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
   
    //upload a logo
    public function uploadLogo($logo)
    {

        $logoExt = explode('.', $logo);
        $logoActualExt = strtolower(end($logoExt));
        $logoNameNew = uniqid('', true) . "." . $logoActualExt;
        $fileDestination =$_SERVER['DOCUMENT_ROOT'] .'/SurplusStays/public/assets/charityImages/' . $logoNameNew;
        $dbFileDestination = $logoNameNew;
        move_uploaded_file($_FILES['logo']['tmp_name'], $fileDestination);

        return $dbFileDestination;
    }
     //upload admin profile picture
     public function uploadProfilePic($logo)
     {
 
         $logoExt = explode('.', $logo);
         $logoActualExt = strtolower(end($logoExt));
         $logoNameNew = uniqid('', true) . "." . $logoActualExt;
         $fileDestination =$_SERVER['DOCUMENT_ROOT'] .'/SurplusStays/public/assets/adminImages/' . $logoNameNew;
         $dbFileDestination = $logoNameNew;
         move_uploaded_file($_FILES['profile_pic']['tmp_name'], $fileDestination);
 
         return $dbFileDestination;
     }
    //update a logo
    public function updateLogo($logo)
    {

        $logoExt = explode('.', $logo);
        $logoActualExt = strtolower(end($logoExt));
        $logoNameNew = uniqid('', true) . "." . $logoActualExt;
        $fileDestination = $_SERVER['DOCUMENT_ROOT'] .'/SurplusStays/public/assets/charityImages/' . $logoNameNew;
        $dbFileDestination = $_SERVER['DOCUMENT_ROOT'] .'/SurplusStays/public/assets/charityImages/' . $logoNameNew;
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $fileDestination);

        return $logoNameNew;
    }
    //update business logo
    public function updateBusinessLogo($logo)
    {

        $logoExt = explode('.', $logo);
        $logoActualExt = strtolower(end($logoExt));
        $logoNameNew = uniqid('', true) . "." . $logoActualExt;
        $fileDestination = $_SERVER['DOCUMENT_ROOT'] .'/SurplusStays/public/assets/businessImages/' . $logoNameNew;
        $dbFileDestination = $_SERVER['DOCUMENT_ROOT'] .'/SurplusStays/public/assets/businessImages/' . $logoNameNew;
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $fileDestination);

        return $logoNameNew;
    }
    //update customer profile picture
    public function updateCustomerPic($logo)
    {

        $logoExt = explode('.', $logo);
        $logoActualExt = strtolower(end($logoExt));
        $logoNameNew = uniqid('', true) . "." . $logoActualExt;
        $fileDestination = $_SERVER['DOCUMENT_ROOT'] .'/SurplusStays/public/assets/customerImages/' . $logoNameNew;
        $dbFileDestination = $_SERVER['DOCUMENT_ROOT'] .'/SurplusStays/public/assets/customerImages/' . $logoNameNew;
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $fileDestination);

        return $logoNameNew;
    }

    //validate Edit Charity
    public function validateEditCharity($DATA)
    {
        $this->errors = array();
        $this->data = array();

        if (!empty($DATA['org_name'])) {
        
            if (!preg_match('/^[a-z A-Z &]+$/', $DATA['org_name'])) {
                
                $this->errors['name'] = "Only letters are allowed for the name";
            } else {
            
                $this->data['name'] = $DATA['org_name'];
                
            }
        }
        $logo = $_FILES['profile_picture']['name'];
        
        $logoExt = explode('.', $logo);
        $logoActualExt = strtolower(end($logoExt));
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($logoActualExt, $allowed)) {
            if ($_FILES['profile_picture']['error'] != 0) {
                $this->errors['logo'] = "There was an error uploading your file!";
            } else if (!in_array($logoActualExt, $allowed)) {
                $this->errors['logo'] = "You cannot upload files of this type!";
            } else {
                $editCharity = new AdminModel();
                $this->data['profile_pic'] = $editCharity->updateLogo($logo);
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

        

        if (count($this->errors) == 0) {
            return true;
        } else {
            return false;
        }
    }
    //validate Edit Business
    public function validateEditBusiness($DATA)
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
        $logo = $_FILES['profile_picture']['name'];
        
        $logoExt = explode('.', $logo);
        $logoActualExt = strtolower(end($logoExt));
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($logoActualExt, $allowed)) {
            if ($_FILES['profile_picture']['error'] != 0) {
                $this->errors['logo'] = "There was an error uploading your file!";
            } else if (!in_array($logoActualExt, $allowed)) {
                $this->errors['logo'] = "You cannot upload files of this type!";
            } else {
                $editBusiness = new AdminModel();
                $this->data['profile_pic'] = $editBusiness->updateBusinessLogo($logo);
            }
        }

        if (!empty($DATA['latitude']) && $DATA['latitude'] != '0') {
            $this->data['latitude'] = $DATA['latitude'];
        }
        
        if (!empty($DATA['longitude']) && $DATA['longitude'] != '0') {
            $this->data['longitude'] = $DATA['longitude'];
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

        if (!empty($DATA['username'])) {
            $this->data['username'] = $DATA['username'];
        }

        if (count($this->errors) == 0) {
            return true;
        } else {
            return false;
        }
    }
}
