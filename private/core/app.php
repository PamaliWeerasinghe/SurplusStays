<?php

//main app file

class App 
{
    //URL format -->/controller/method/params

    protected $controller = "home";
    protected $method = "index";
    protected $params = array();

    public function __construct()
    {
        $URL = $this->getURL();
        if(file_exists("../private/controllers/".$URL[0].".php"))
        {
            $this->controller = ucfirst($URL[0]);

            unset($URL[0]); 
            //removes the first item
        }
        
        //call the controller
        require "../private/controllers/".$this->controller.".php";

        //instantiate controller class
        $this->controller = new $this->controller();

        if(isset($URL[1])) 
        {
            if(method_exists($this->controller, $URL[1]))
            {
                $this->method = ucfirst($URL[1]);
                unset($URL[1]);
            }
        }

        $URL = array_values($URL); //always set the starting parameter in array[0]

        //Getting the paramaters list
        $this->params = $URL;
        call_user_func_array([$this->controller,$this->method], $this->params);
    }

    private function getURL() 
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        //if the URL is empty redirect to home

        return explode("/", filter_var(trim($url, "/")), FILTER_SANITIZE_URL);
        //GET variable gets all the parameters from the URL and adds the into an array
        //trim seperates them by a '/'
        //filter_var(),FILTER_SANITIZE_URL removes unwanted characters to protect from malicious inputs                                                                        
    }

}