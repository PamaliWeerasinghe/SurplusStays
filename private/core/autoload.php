<?php

//every file created in the core must be added here

require "config.php";
require "functions.php";
require "database.php";
require "controller.php";
require "admin_model.php";
require "model.php";
require "PHPMailer.php";
require "SMTP.php";
require "Exception.php";
require "app.php";

spl_autoload_register(function($class_name){
    require "../private/models/". ucfirst($class_name) . ".php";
});