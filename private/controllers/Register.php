<?php

//home controller

class Register extends Controller
{
    function index()
    {    
        $this->view('register');
    }

     // This method handles displaying the charity login page
     function charity()
     {
        $errors = array();
        if(count($_POST)>0)
        {
            $user = new Organization();

            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/charityImages/";
                $fileName = basename($_FILES['profile_picture']['name']);
                $filePath = $targetDir . $fileName;
                $fileType = pathinfo($filePath, PATHINFO_EXTENSION);

                // Allow certain file formats
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileType, $allowedTypes)) {
                    // Attempt to move uploaded file
                    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $filePath)) {
                        $_POST['picture'] = $filePath; // Save file path to $_POST
                    } else {
                        $errors[] = "Failed to upload the profile picture.";
                    }
                } else {
                    $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed.";
                }
            } else {
                $errors[] = "Please upload a profile picture.";
            }

            if($user->validate($_POST))
            {
                $arr['name'] = $_POST['name'];
                $arr['email'] = $_POST['email'];
                $arr['phoneNo'] = $_POST['phone'];
                $arr['username'] = $_POST['username'];
                $arr['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $arr['city'] = $_POST['city'];
                $arr['charity_description'] = $_POST['description'];
                $arr['picture'] = $_POST['picture'];
                $arr['status_id'] = 1;
                
                $user->insert($arr);
                $this->redirect('login');
            }else
            {
                $errors = $user->errors;
            }
        }
        $this->view('charity_register-1',[
            'errors'=>$errors,
        ]);
     }

     function customer()
     {
        $errors = array();
        if(count($_POST)>0)
        {
            $user = new Customer();

            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/customerImages/";
                $fileName = basename($_FILES['profile_picture']['name']);
                $filePath = $targetDir . $fileName;
                $fileType = pathinfo($filePath, PATHINFO_EXTENSION);

            // Allow certain file formats
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileType, $allowedTypes)) {
                // Attempt to move uploaded file
                if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $filePath)) {
                    $_POST['picture'] = $filePath; // Save file path to $_POST
                } else {
                    $errors[] = "Failed to upload the profile picture.";
                }
            } else {
                $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed.";
            }
        }else {
            $errors[] = "Please upload a profile picture.";
        }
        if($user->validate($_POST))
            {
                $arr['fname'] = $_POST['fname'];
                $arr['lname'] = $_POST['lname'];
                $arr['email'] = $_POST['email'];
                $arr['phoneNo'] = $_POST['phone'];
                $arr['username'] = $_POST['username'];
                $arr['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $arr['status_id'] = 1;
                $arr['picture'] = $_POST['picture'];
            
                $user->insert($arr);
                $this->redirect('login');
            }else
            {
                $errors = $user->errors;
            }
        }

        $this->view('/customerRegistration',[
            'errors'=>$errors,
        ]);
     }

     function business()
    {
        
        $errors = array();
        if (count($_POST) > 0) {
            $user = new Business();

            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/businessImages/";
                $fileName = basename($_FILES['profile_picture']['name']);
                $filePath = $targetDir . $fileName;
                $fileType = pathinfo($filePath, PATHINFO_EXTENSION);
                // Allow certain file formats
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileType, $allowedTypes)) {
                    // Attempt to move uploaded file
                    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $filePath)) {
                        $_POST['picture'] = $filePath; // Save file path to $_POST
                    } else {
                        $errors[] = "Failed to upload the profile picture.";
                    }
                } else {
                    $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed.";
                }
            } else {
                $errors[] = "Please upload a profile picture.";
            }




            if ($user->validate($_POST)) {
                $arr['name'] = $_POST['name'];
                $arr['email'] = $_POST['email'];
                $arr['phone_no'] = $_POST['phone'];
                $arr['username'] = $_POST['username'];
                $arr['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $arr['business_type'] = $_POST['type'];
                $arr['picture'] = $_POST['picture'];
                $arr['address'] = $_POST['address'];
                $arr['status_id'] = 1;

                $user->insert($arr);
                $this->redirect('login');
            } else {
                $errors = $user->errors;
            }
        }
        $this->view('business_register', [
            'errors' => $errors,
        ]);
    }

     function login()
    {    
        $this->redirect('/login');
    }
}


