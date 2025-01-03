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
        try {
            $con = $this->connect();
            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stm = $con->prepare($query);
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

            return is_array($data) && count($data) > 0 ?$data:[];
        } catch (PDOException $e) {
            error_log("Database query error: ".$e->getMessage());
            return false;
        }
       
    }

}


