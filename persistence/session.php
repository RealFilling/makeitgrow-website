<?php
require_once('settings.php');
global $_THEDOMAIN;

if (isset($_COOKIE['PHPSESSID']))
{
	//session_id($_COOKIE['PHPSESSID']);
}
//ini_set('session.cookie_domain', '.' . $_THEDOMAIN);
//session_name("thegreendream");
session_set_cookie_params(0, '/', '.' . $_THEDOMAIN);
session_start();