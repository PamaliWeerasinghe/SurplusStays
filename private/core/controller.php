<?php

//main controller class

class Controller
{
    //To load the view
    public function view($view,$data = array())
    {
        extract($data);

        if(file_exists("../private/views/" . $view . ".view.php"))
        {
            require("../private/views/" . $view . ".view.php");
        }
        else {
            require("../private/views/404.view.php");
        }
    }
    //To load the model
        public function model($model){
            //watch simpleEPIC #7

        }
}