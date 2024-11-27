<?php

//home controller

class Register extends Controller
{
    function index()
    {    
        $this->view('register');
    }

     // This method handles displaying the customer login page
     function customer()
     {
        $errors = array();
        if(count($_POST)>0)
        {
            $user = new Customer();

            if($user->validate($_POST))
            {
                $arr['name'] = $_POST['name'];
                $arr['email'] = $_POST['email'];
                $arr['phoneNo'] = $_POST['phone'];
                $arr['username'] = $_POST['username'];
                $arr['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $arr['city'] = $_POST['city'];
                $arr['status_id'] = 1;
                
                $user->insert($arr);
                $this->redirect('login');
            }else
            {
                $errors = $user->errors;
            }
        }
        $this->view('AddNewCustomer',[
            'errors'=>$errors,
        ]);
     }

     function login()
    {    
        $this->redirect('/login');
    }
}

