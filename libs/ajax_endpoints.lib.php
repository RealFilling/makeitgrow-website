<?php
require_once('utils.lib.php');
require_once('persistence.lib.php');

// Verify the username
function verifyUsername() {
	$username = filterInput($_REQUEST['username']);

	if (userExists($username))
		return formatData(false,"Username is taken");
	else
		return formatData(true,"Username is available"));
}

// Verify the email
function verifyEmail() {
	$email = filterInput($_REQUEST['email']);

	if (mailExists($email))
		return formatData(false,"Email is taken");
	else
		return formatData(true,"Email is available"));
}

// Verify the farm
function verifyFarmname() {
	$farmname = filterInput($_REQUEST['farmname']);

	if (farmExists($farmname))
		return formatData(false,"Farm name is taken");
	else
		return formatData(true,"Farm name is available"));
}

// Save
function saveGame() {
	if (isset($_SESSION['user_id']))
	{
		// retrieve data
		if (isset($_REQUEST['data']))
		{
			saveSavegame($_SESSION['user_id'], $_REQUEST['data']);
			return formatData(true, 'Data saved');
		}
		else
		{
			return formatData(false, 'Invalid or absent data');
		}
	}
	else
	{
		return formatData(false, 'User not logged in');
	}
}

// Register new user
function register() {
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
			
			return formatData(true, $data);
		}
		else
		{
			return formatData(false, $errorMsg);
		}
	}
}

// Logout
function logout() {
	$_SESSION['user_id'] = 0;
	unset($_SESSION['user_id']);
	return formatData(true, 'Location: http://www.' . DOMAIN. '/index.php' );
}

// Login
function login() {
	if (isset($_REQUEST['login']))
	{
		$name = filterInput($_REQUEST['name']);
		$password = filterInput($_REQUEST['password']);
		
		$id = getUserId($name, $password);

		if ($id > 0)
		{
			$_SESSION['user_id'] = $id;
			
			return formatData(true, getSubdomain());
		}
		else
		{
			return formatData(false, getSubdomain());
		}
	}
}

// Load
function loadGame() {
	if (isset($_SESSION['user_id']))
	{
		$data = loadSavegame($_SESSION['user_id']);
		return formatData(true, $data);
	}
	else
	{
		return formatData(false, 'user not logged in');
	}
}

// Is Logged in?
function isLoggedIn() {
	if (isset($_SESSION['user_id']))
	{
		return formatData(true, '');
	}
	else
	{
		return formatData(false, 'user is not logged in');
	}
}

// Forgot Password -> this is useless
function forgotPassword() {
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
		
		return formatData(true, '');
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
		
		return formatData(true, '');
	}
	else
	{
		return formatData(false, 'Unknown farm or e-mail');
	}
}