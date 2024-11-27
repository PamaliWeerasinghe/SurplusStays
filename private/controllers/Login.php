<?php

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

    function charityLogin() {
        $errors = array();
        if(count($_POST) > 0) {
            $user = new Organization();
            if($row = $user->where('email', $_POST['email'])) {
                $row = $row[0];
                if(password_verify($_POST['password'], $row->password)) 
                {
                    Auth::authenticate($row);
                    $this->redirect('/charity');
                }
            }
                $errors['email'] = "Wrong email or password";              
        }
        $this->view('charityLogin', [
            'errors' => $errors,
        ]);
    }

    function customerLogin() {
        $errors = array();
        if(count($_POST) > 0) {
            $user = new Customer();
            if($row = $user->where('email', $_POST['email'])) {
                $row = $row[0];
                if(password_verify($_POST['password'], $row->password)) 
                {
                    Auth::authenticate($row);
                    $this->redirect('/customer');
                }
            }
                $errors['email'] = "Wrong email or password";              
        }
        $this->view('customerLogin', [
            'errors' => $errors,
        ]);
    }
}