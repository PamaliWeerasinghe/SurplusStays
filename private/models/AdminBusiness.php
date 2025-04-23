<?php 
class AdminBusiness extends AdminModel
{
    public function validateBusiness($DATA)
    {
        $this->errors=array();
        //validate fname and lname
        if (!preg_match('/^[a-z A-Z &]+$/', $DATA['name'])) {
            $this->errors['name'] = "Only letters are allowed for the first name";
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
 
         if (empty($_FILES['profile_picture']['name'])) {
             $this->errors['profile_picture'] = "Select a profile photo";
         }
         if(empty($DATA['latitude']) && empty( $DATA['longitude']) ){
            $this->errors['location']="Select Location";
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
     //upload business profile picture
     public function uploadBusinessPic($logo)
     {
 
         $logoExt = explode('.', $logo);
         $logoActualExt = strtolower(end($logoExt));
         $logoNameNew = uniqid('', true) . "." . $logoActualExt;
         $fileDestination =$_SERVER['DOCUMENT_ROOT'] .'/SurplusStays/public/assets/businessImages/' . $logoNameNew;
         $dbFileDestination = $logoNameNew;
         move_uploaded_file($_FILES['profile_picture']['tmp_name'], $fileDestination);
 
         return $dbFileDestination;
     }

     public function insertBusiness($user_columns,$user_values,$business_columns,$business_values,$user,$add_business)
    {
        try {
            
            if(empty($this->where(['email'],[$user_values[0]],'user')) ){
                //begin the transaction
                $this->db->beginTransaction();
                
                //insert the user
                if($this->insert($user,'user')){
                    
                    $this->db->rollback();
                    return false;
                }
                
                //get the last id
                $id=$this->db->lastInsertId();
                
                //Insert into business table
                $add_business['user_id']=$id;
                if($this->insert($add_business,'business')){
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
}
?>