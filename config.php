<?php
define("DB_HOST","localhost");
define("DB_USR", "greendream");
define("DB_PWD", "InTheGarden1");
define("DB_NAME", "thegreendream");

define("DOMAIN",'makeitgrowgame.com');
define("DOMAIN_SHORT","mig.com");

define('FB_APPID','286926808080601');
define('FB_SECRET','dd4587d6dab3dcbeddaa04613d69ea35');

// Connect to the database and initialize the session
$db = new mysqli(DB_HOST, DB_USR, DB_PWD, DB_NAME);
if ($db->connect_errno) {
    echo "DB Connection failed: " . $db->connect_error;
}

session_set_cookie_params(0, '/', '.' . DOMAIN);
session_start();
