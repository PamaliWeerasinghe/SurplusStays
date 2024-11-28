<?php

class Login extends Controller
{
    //function __construct()
    //{
    //Ensures that the session is started
    //session_start();
    //}

    function index()
    {
        if (AdminAuth::logged_in()) {
            $this->view('adminWelcomePage');
        } else {
            $errors = array();

            if (count($_POST) > 0) {
                $user = new User();
                // $charityOrg = $user->findAll('organization');

                $email = $user->where('email', $_POST['email'], 'user');


                if ($email) {
                    $all = $email[0];
                    if ($all->role == 'admin') {
                        $password = $user->where('password', $_POST['password'], 'user');
                        if ($password) {
                            $role = $password[0];
                            $admin_email = $user->where('email', $_POST['email'], 'admin');
                            if ($admin_email) {
                                $admin_password = $user->where('verification_code', $_POST['password'], 'admin');
                                if ($admin_password) {
                                    $admin = $admin_password[0];
                                    AdminAuth::authenticate($admin);
                                    $this->view('AdminWelcomePage', [
                                        'adminDetails' => $admin
                                    ]);
                                } else {
                                    $errors['email'] = "Please check your password";
                                    $this->view('AdminLoginStep1', [
                                        'errors' => $errors
                                    ]);
                                }
                            }
                        }
                    } else {
                        $password = $all->password;
                        if ($all->role == 'customer') {
                            if (password_verify($_POST['password'], $password)) {
                                $customer_email = $user->where('email', $_POST['email'], 'customer');
                                if ($customer_email) {
                                    $customer = $customer_email[0];
                                    Auth::authenticate($customer);
                                    $this->view('CustomerDashboard', [
                                        'customerDetails' => $customer
                                    ]);
                                } else {
                                    $this->view('404');
                                }
                            } else {
                                $errors['password'] = "Please check your password";
                                $this->view('AdminLoginStep1', [
                                    'errors' => $errors
                                ]);
                            }
                        } else if ($all->role == 'charity') {
                            if (password_verify($_POST['password'], $password)) {
                                $charity_email = $user->where('email', $_POST['email'], 'organization');
                                if ($charity_email) {
                                    $charity = $charity_email[0];
                                    Auth::authenticate($charity);
                                    $this->view('charity_dashboard', [
                                        'rowCount' => $charity
                                    ]);
                                } else {
                                    $this->view('404');
                                }
                            } else {
                                $errors['password'] = "Please check your password";
                                $this->view('AdminLoginStep1', [
                                    'errors' => $errors
                                ]);
                            }
                        } else {
                            if (password_verify($_POST['password'], $password)) {
                                $business_email = $user->where('email', $_POST['email'], 'business');
                                if ($business_email) {
                                    $business= $business_email[0];
                                    Auth::authenticate($business);
                                    $this->view('business_AddProduct', [
                                        'businessDetails' => $business
                                    ]);
                                } else {
                                    $this->view('404');
                                }
                            } else {
                                $errors['password'] = "Please check your password";
                                $this->view('AdminLoginStep1', [
                                    'errors' => $errors
                                ]);
                            }
                        }
                    }
                } else {
                    $errors['email'] = "Please check your email";
                    $this->view('AdminLoginStep1', [
                        'errors' => $errors
                    ]);
                }
            } else {
                $this->view('AdminLoginStep1');
            }
        }
    }
}
