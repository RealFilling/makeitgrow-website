<?php
require_once('session.php');
require_once('database.php');
require_once('functions.php');

if (isset($_SESSION['user_id']))
{
	printData('ok', '');
}
else
{
	printData('error', 'user is not logged in');
}
?>