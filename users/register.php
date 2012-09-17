<?php
require_once("../config/index.php");
require_once('../libs/index.php');

if (isset($_REQUEST['register']))
{
	$name = filterInput($_REQUEST['name']);
	$password = filterInput($_REQUEST['password']);
	$email = filterInput($_REQUEST['email']);
	$farm = filterInput($_REQUEST['farm']);
	$data = filterInput($_REQUEST['data']);

	
	$id = 0;
	$error = false;
	$errorMsg = '';
	
	// TO-DO: Add more verification filters!
	// Remember: Farm name should be unique
	// Remember: User name should not be unique
	if (farmExists($name) > 0)
	{
		$error = true;
		$errorMsg = 'Farm name is already taken';
	}
	
	if (mailExists($email))
	{
		$error = true;
		$errorMsg = 'e-mail is already registered';
	}
	
	if (!$error)
	{
		// Register user
		$id = registerUser($name, $password, $email, $farm);
	}

	if (!($id > 0) && !$error)
	{
		$error = true;
		$errorMsg = 'Error while registering';
	}
	// Get the ID
	//$id = getUserId($name, $password);
	
	if (!$error)
	{
		$_SESSION['user_id'] = $id;
		
		$data = loadSavegame($id);
		
		// Send e-mail notification
		$to = $email;
		$subject = 'Welcome to The Green Dream!';
		$message = "Welcome to The Green Dream!\n\nYou registered with the user $name, and your farm name is $farm.\n\nWe hope you enjoy the game.\n\n\nCheers,\nThe Green Dream Team";
		sendMail($to, $subject, $message);
		
		printData('ok', $data);
	}
	else
	{
		printData('error', $errorMsg);
	}
	
	
}
/*
Welcome to The Green Dream!

You registered with the user <username>, and your farm name is <farm name>.

We hope you enjoy the game.


Cheers,
The Green Dream Team
--------------

For pre-multiplayer:

---------------
It's a beautiful day in the Green Dream

Welcome to the farm <user>! Only you can make <farm name> a paradise that feeds a neighborhood. 

<Green dream logo with words "Play Now" emblazoned>linkembed</a>

Sincerely,
The Green Dream Team
---------------

For post-Beta:

---------------
It's morning again in the Green Dream

Welcome to the farm <user>, invite people you trust to help grow <farm name> into a cornucopia that feeds a county! 

<Facebook Link Button to select invitees>

<Twitter Link Button>

<Google Link Button>

Sincerely,
The Green Dream Team
*/