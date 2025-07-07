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
        $_SESSION['USER_ROLE']=$user->role;

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
    public static function admin()
    {   
        if(isset($_SESSION['USER']))
        {
            return $_SESSION['USER']->name;
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
    public static function getUserRole()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user session contains an organization ID
        if(isset($_SESSION['USER_ROLE']))
        {
            return $_SESSION['USER_ROLE'];
        }
    }
    public static function getUserPicture()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if(isset($_SESSION['USER']->user_id)) {
            $db = Database::getInstance();
            $id = $_SESSION['USER']->user_id;

            $query = "SELECT profile_pic FROM user WHERE id = :id LIMIT 1";
            $result = $db->query($query, ['id' => $id],'assoc');

            if($result && isset($result[0]['profile_pic'])) {
                return $result[0]['profile_pic'];
            }
        }

        return 'default.jpg'; // fallback image
    }
}