<?php

class Auth
{
    public static function authenticate($row,$user)
    {
        
        if (session_status() == PHP_SESSION_NONE) {
           session_start();
        }
        $_SESSION['USER'] = $row;

        $_SESSION['USER_EMAIL']=$user->email;
        $_SESSION['USER_PIC']=$user->profile_pic;
        $_SESSION['USER_REG_DATE']=$user->reg_date;

    }
   //logout
   public static function logout()
   {
       unset($_SESSION['USER']);
       unset($_SESSION['USER_EMAIL']);
       unset($_SESSION['USER_PIC']);
       unset( $_SESSION['USER_REG_DATE']);
   }

   public static function logged_in()
   {
       if(session_status()==PHP_SESSION_NONE){
           session_start();
       }
       if (isset($_SESSION['USER'])) {
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