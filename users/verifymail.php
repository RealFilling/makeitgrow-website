<?php
require_once("../config/index.php");
require_once('../libs/index.php');

$name = filterInput($_REQUEST['name']);

if (mailExists($name))
{
	echo "EXISTS";
}
else
{
	echo "OK";
}