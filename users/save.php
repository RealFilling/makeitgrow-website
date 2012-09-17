<?php
require_once("../config/index.php");
require_once('../libs/index.php');

if (isset($_SESSION['user_id']))
{
	// retrieve data
	if (isset($_REQUEST['data']))
	{
		saveSavegame($_SESSION['user_id'], $_REQUEST['data']);
		printData('ok', 'data saved');
	}
	else
	{
		printData('error', 'invalid or absent data');
	}
}
else
{
	printData('error', 'user not logged in');
}