<?php
require_once("../config/index.php");
require_once('../libs/index.php');

if (isset($_SESSION['user_id']))
{
	$data = loadSavegame($_SESSION['user_id']);
	printData('ok', $data);
}
else
{
	printData('error', 'user not logged in');
}