<?php 
class TokenHandler{
    public static function generateToken($length=32){
        return bin2hex(random_bytes($length));
    }
    //generate the expiry date
    public static function generateExpiryDate($time='1 hour'){
        return date('Y-m-d H:i:s',strtotime('+'.$time));
    }
    //validate token, check if the token has expired
    public static function validateToken($expiryDate){
        return (strtotime($expiryDate)>time())?true:false;
    }
}

?>