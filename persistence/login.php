<?php
require_once('session.php');
require_once('database.php');
require_once('functions.php');

if (isset($_REQUEST['login']))
{
	$name = filterInput($_REQUEST['name']);
	$password = filterInput($_REQUEST['password']);
	
	$id = getUserId($name, $password);

	if ($id > 0)
	{
		$_SESSION['user_id'] = $id;
		
		printData('ok', getSubdomain());
	}
	else
	{
		printData('error', getSubdomain());
	}
}