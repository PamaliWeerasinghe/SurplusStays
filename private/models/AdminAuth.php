<?php

class AdminAuth
{
    public static function authenticate($row)
    {
        if (session_status() == PHP_SESSION_NONE) {
           session_start();
        }
        $_SESSION['ADMIN'] = $row;
    }

    //logout
    public static function logout()
    {
        unset($_SESSION['ADMIN']);
    }

    //check whether an admin is logged in
    public static function logged_in()
    {
        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }
        if (isset($_SESSION['ADMIN'])) {
            return true;
        }
        return false;
    }

    //retrieve details from the session variable
    public static function admin()
    {
        if (isset($_SESSION['ADMIN'])) {
            return $_SESSION['ADMIN']->name;
        }
    }

    //get a function that doesn't exist

}
