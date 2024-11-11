<?php

//home controller

class Login extends Controller
{
    function __construct()
    {
        // Ensures that the session is started
        session_start();
    }
    
    function index()
    {
        $this->view('login');
    }

    function businessLogin() {
        $errors = array();
        if(count($_POST) > 0) {
            $user = new Business();
            if($row = $user->where('email', $_POST['email'])) {
                $row = $row[0];
                if(password_verify($_POST['password'], $row->password)) 
                {
                    Auth::authenticate($row);
                    $this->redirect('/business');
                }
            }
                $errors['email'] = "Wrong email or password";              
        }
        $this->view('business_login', [
            'errors' => $errors,
        ]);
    }

    
}
