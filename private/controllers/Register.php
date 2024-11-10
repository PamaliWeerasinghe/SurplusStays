<?php

//home controller

class Register extends Controller
{
    function index()
    {
        $this->view('register');
    }

    // This method handles displaying the charity login page
    function business()
    {
        
        $errors = array();
        if (count($_POST) > 0) {
            $user = new Business();
            if ($user->validate($_POST)) {
                $arr['name'] = $_POST['name'];
                $arr['email'] = $_POST['email'];
                $arr['phoneNo'] = $_POST['phone'];
                $arr['username'] = $_POST['username'];
                $arr['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $arr['businessType'] = $_POST['type'];
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
