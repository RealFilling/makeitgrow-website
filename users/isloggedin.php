<?php
require_once("../config/index.php");
require_once('../libs/index.php');

if (isset($_SESSION['user_id']))
{
	printData('ok', '');
}
else
{
	printData('error', 'user is not logged in');
}