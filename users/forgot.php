<?php
require_once("../config/index.php");
require_once('../libs/index.php');

$farm = filterInput($_REQUEST['farm']);
$email = filterInput($_REQUEST['email']);

$emailid = mailExists($email);
$farmid = farmExists($farm);

if ($emailid > 0)
{
	$name = getUser($emailid);
	$farm = getFarm($emailid);
	$password = getPassword($emailid);

	// Send e-mail notification
	$to = $email;
	$subject = 'Make it Grow - Password request';
	$message = "You or someone requested your password from Make it Grow. If it wasn't you, you can disregard this e-mail.\n\nYour user name is '$name', your farm name is '$farm' and your password is '$password' (without the quotes).\n\nWe hope you enjoy the game.\n\n\nCheers,\nMake it Grow Team";
	sendMail($to, $subject, $message);
	
	printData('ok', '');
}
else if ($farmid > 0)
{
	$name = getUser($farmid);
	$email = getMail($farmid);
	$password = getPassword($farmid);
	
	// Send e-mail notification
	$to = $email;
	$subject = 'Make it Grow - Password request';
	$message = "You or someone requested your password from Make it Grow. If it wasn't you, you can disregard this e-mail.\n\nYour user name is '$name', your farm name is '$farm' and your password is '$password' (without the quotes).\n\nWe hope you enjoy the game.\n\n\nCheers,\nMake it Grow Team";
	sendMail($to, $subject, $message);
	
	printData('ok', '');
}
else
{
	printData('error', 'Unknown farm or e-mail');
}