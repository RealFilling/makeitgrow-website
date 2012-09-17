<?php
// Database constants
define("DB_HOST","localhost");
define("DB_USR", "greendream");
define("DB_PWD", "InTheGarden1");
define("DB_NAME", "thegreendream");

// Application constants
define("DOMAIN",'makeitgrowgame.com');
define("DOMAIN_SHORT","mig.com");

// Facebook constants
define('FB_APPID','286926808080601');
define('FB_SECRET','dd4587d6dab3dcbeddaa04613d69ea35');
define('FB_REDIRECT',"www.makeitgrowgame.com/");

// Connect to the database
mysql_connect(DB_HOST, DB_USR, DB_PWD) or die("MySQL Error: " . mysql_error());
mysql_select_db(DB_NAME) or die("MySQL Error: " . mysql_error());

// Initialize the session
session_set_cookie_params(0, '/', '.' . DOMAIN);
session_start();

// Get Facebook up and running
require_once("libs/facebook/facebook.php");

$config = array();
$config["fb_app_id"] = FB_APPID;
$config["fb_app_secret"] = FB_SECRET;
$config["base_url"] = FB_REDIRECT;
$config["fb_fields"] = array(
    	array("name" => "name")
    ,	array("name" => "email")
    ,   array("name" => "farmname")
    //,	array("name" => "gender")
    //,	array("name" => "birthday")
);

$facebook = new Facebook($config);