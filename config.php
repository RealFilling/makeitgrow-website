<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

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
