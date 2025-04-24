<?php
// root directory URL
define('APPROOT', dirname(dirname(__FILE__)));

//URL ROOT
define('URLROOT', 'http://localhost:8080/SurplusStays');

//WEBSITE
define('SITENAME', 'surplusStays');

define('PHPMAILER',dirname(dirname(dirname(__FILE__))) . '/PHPMailer');
define('ROOT', 'http://localhost:8080/SurplusStays/public');
define('STYLES', 'http://localhost:8080/SurplusStays/public/assets/styles');
define('ASSETS', 'http://localhost:8080/SurplusStays/public/assets');
define('SIDEPANELBUSINESS', '/SurplusStays/public/business');
define('COMPLAINTS', 'http://localhost:8080/SurplusStays/public/assets/complaints/');
define('CUSTOMER','http://localhost:8080/SurplusStays/public/assets/customerImages');
define('BUSINESS','http://localhost:8080/SurplusStays/public/assets/businessImages');
define('LOGIN','http://localhost:8080/SurplusStays/public/login');
define('FORGOT','http://localhost:8080/SurplusStays/public/forgot');
define('TEMPLATEROOT', 'http://localhost:8080/SurplusStays/templates');
define('ADMIN','http://localhost:8080/SurplusStays/public/admin');
//DATABASE
define('DBNAME','surplusstays_latest');
define('DBHOST','localhost');
//alwaysdata-host mysql-surplusstays.alwaysdata.net
define('DBUSER','root');
//alwaysdata-username  386124_pamali
define('DBPASS','');
//alwaysdata-password Pamali2002
define('DBDRIVER','mysql');

// Enable error displaying (for development only, consider disabling in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//mail config
define('SMTP_SETTINGS',[
    'smtp_host'=>'smtp.gmail.com',
    'smtp_auth'=>true,
    'smtp_username'=>'pamaliweerasinghe@gmail.com',
    'smtp_password'=>'dhne nmbj mtup cldi',
    'smtp_secure'=>'tls',
    'smtp_port'=>587,
    'from_email'=>'pamaliweerasinghe@gmail.com',
    'from_name'=>'SurplusStays'
]);

//start a session
session_start();
define('VENDOR','D:\xampp\htdocs\SurplusStays\vendor\autoload.php');

?>