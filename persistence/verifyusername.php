<?php
require_once('session.php');
require_once('database.php');
require_once('functions.php');

$name = filterInput($_REQUEST['name']);

if (userExists($name))
{
	echo "EXISTS";
}
else
{
	echo "OK";
}