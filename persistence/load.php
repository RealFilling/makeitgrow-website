<?php
require_once('session.php');
require_once('database.php');
require_once('functions.php');

if (isset($_SESSION['user_id']))
{
	$data = loadSavegame($_SESSION['user_id']);
	printData('ok', $data);
}
else
{
	printData('error', 'user not logged in');
}