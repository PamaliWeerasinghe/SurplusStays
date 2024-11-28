<?php

//every file created in the core must be added here

require "config.php";

//load libraries
require "functions.php";
require "database.php";
require "controller.php";
// require "model.php";
require "admin_model.php";
require "model.php";
require "app.php";

spl_autoload_register(function($class_name){
    require "../private/models/". ucfirst($class_name) . ".php";
});