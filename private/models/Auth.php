<?php

class Auth
{
    public static function authenticate($row)
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['USER'] = $row;
    }

    public static function logout()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['USER']))
        {
            unset($_SESSION['USER']);
        }
    }

    public static function logged_in()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if(isset($_SESSION['USER']))
        {
            return true;
        }

        return false;
    
    }

    public static function user()
    {   
        if(isset($_SESSION['USER']))
        {
            return $_SESSION['USER']->username;
        }

        return false;
    
    }

    public static function __callStatic($method,$params)
    {   
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $prop = strtoLower(str_replace("get","", $method));

        if(isset($_SESSION['USER']->$prop))
        {
            return $_SESSION['USER']->$prop;
        }

        return 'Unknown';
    
    }

    public static function getUserId()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user session contains an organization ID
        if(isset($_SESSION['USER']->id))
        {
            return $_SESSION['USER']->id;
        }
    }
}