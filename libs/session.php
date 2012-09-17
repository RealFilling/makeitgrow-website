<?php
if (isset($_COOKIE['PHPSESSID']))
{
	//session_id($_COOKIE['PHPSESSID']);
}
//ini_set('session.cookie_domain', '.' . DOMAIN);
//session_name("thegreendream");
session_set_cookie_params(0, '/', '.' . DOMAIN);
session_start();