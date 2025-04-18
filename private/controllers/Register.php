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
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $organization = new Organization();
            $userTable = new User();

            //Check if the email is already in use
            $email = $_POST['email'];
            $existingUser = $userTable->where('email', $email, 'user');
            if ($existingUser) {
                $errors[] = "Email already exists.";
            }

            // Handle profile picture
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/charityImages/";
                $fileName = basename($_FILES['profile_picture']['name']);
                $filePath = $targetDir . $fileName;
                $fileType = pathinfo($filePath, PATHINFO_EXTENSION);

                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $filePath)) {
                        $_POST['picture'] = $fileName;
                    } else {
                        $errors[] = "Failed to upload the profile picture.";
                    }
                } else {
                    $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed.";
                }
            } else {
                $errors[] = "Please upload a profile picture.";
            }

            if (empty($errors) && $organization->validate($_POST)) {
                // Insert into user table
                $userData = [
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'role' => 'charity',
                    'profile_pic' => $_POST['picture'],
                    'reg_date' => date('Y-m-d H:i:s'),
                    'status_id' => 1 // active
                ];

                $userTable->insert($userData);
                // Fetch the inserted user by email to get the ID
                $insertedUser = $userTable->where('email', $_POST['email'], 'user');

                if ($insertedUser && isset($insertedUser[0]->id)) {
                    $user_id = $insertedUser[0]->id;
                }

                if ($user_id) {
                    // Insert into organization table
                    $orgData = [
                        'name' => $_POST['name'],
                        'phoneNo' => $_POST['phone'],
                        'username' => $_POST['username'],
                        'city' => $_POST['city'],
                        'charity_description' => $_POST['description'],
                        'user_id' => $user_id
                    ];

                    $organization->insert($orgData);
                    $this->redirect('login');
                } else {
                    $errors[] = "Failed to create user.";
                }
            } elseif (!$organization->validate($_POST)) {
                $errors = $organization->errors;
            }
        }

        $this->view('charity_register-1', ['errors' => $errors]);
    }


    function customer()
    {
        $errors = array();
        if (count($_POST) > 0) {
            $customer = new Customer(); // Model for `customer` table
            $userTable = new User(); // Model for `user` table

            // Handle file upload for profile picture
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/customerImages/";
                $fileName = basename($_FILES['profile_picture']['name']);
                $filePath = $targetDir . $fileName;
                $fileType = pathinfo($filePath, PATHINFO_EXTENSION);

                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $filePath)) {
                        $_POST['picture'] = $fileName; // Save file name to $_POST
                    } else {
                        $errors[] = "Failed to upload the profile picture.";
                    }
                } else {
                    $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed.";
                }
            } else {
                $errors[] = "Please upload a profile picture.";
            }

            // Validate and process form data
            if ($customer->validate($_POST)) {
                // Save data to `customer` table
                $customerData = [
                    'fname' => $_POST['fname'],
                    'lname' => $_POST['lname'],
                    'email' => $_POST['email'],
                    'phoneNo' => $_POST['phone'],
                    'username' => $_POST['username'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'status_id' => 1,
                    'picture' => $_POST['picture'],
                ];

                $customer->insert($customerData);

                // Save data to `user` table
                $userData = [
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'role' => 'customer',
                ];

                $userTable->insert($userData);

                $this->redirect('login');
            } else {
                $errors = $customer->errors;
            }
        }

        // Render the customer registration view
        $this->view('/customerRegistration', [
            'errors' => $errors,
        ]);
    }

    function business()
    {
        $errors = array();
        if (count($_POST) > 0) {
            $business = new Business(); // Model for `business` table
            $userTable = new User();    // Model for `user` table

            // Handle file upload for profile picture
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/businessImages/";
                $fileName = basename($_FILES['profile_picture']['name']);
                $filePath = $targetDir . $fileName;
                $fileType = pathinfo($filePath, PATHINFO_EXTENSION);

                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $filePath)) {
                        $_POST['picture'] = $fileName; // Save file name to $_POST
                    } else {
                        $errors[] = "Failed to upload the profile picture.";
                    }
                } else {
                    $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed.";
                }
            } else {
                $errors[] = "Please upload a profile picture.";
            }

            // Validate and process form data
            if ($business->validate($_POST)) {
                // Save data to `business` table
                $businessData = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'phone_no' => $_POST['phone'],
                    'username' => $_POST['username'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'business_type' => $_POST['type'],
                    'picture' => $_POST['picture'],
                    'address' => $_POST['address'],
                    'status_id' => 1,
                ];

                $business->insert($businessData);

                // Save data to `user` table
                $userData = [
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'role' => 'business',
                ];

                $userTable->insert($userData);

                $this->redirect('login');
            } else {
                $errors = $business->errors;
            }
        }

        // Render the business registration view
        $this->view('business_register', [
            'errors' => $errors,
        ]);
    }


     function login()
    {    
       $this->redirect('/Login');
    } 
}


