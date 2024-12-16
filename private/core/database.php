<?php

class Database
{   
    private static $instance = null;

    private function __construct()
    {
        $this->connect();
    }

    private function connect() 
    {
        $string = DBDRIVER . ":host=".DBHOST.";dbname=".DBNAME;
        if(!$con = new PDO($string,DBUSER,DBPASS)){
            die("could not connect to the database");
        }

        return $con;
        
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function query($query, $data = array(), $data_type = "object") 
    {
        $con = $this->connect();
        $stm = $con->prepare($query);

        if($stm){
            $check = $stm->execute($data);
            if($check) {
                if($data_type == "object") {
                    $data = $stm->fetchAll(PDO::FETCH_OBJ);
                    }
                else{
                    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                }
                if(is_array($data) && count($data)>0){
                    return $data; 
                }
            }
        }

        return false;
    }

}


