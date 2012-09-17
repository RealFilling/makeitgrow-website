<?php
function printData($status, $data)
{
$output = "{
    \"result\": {
        \"status\": \"$status\",
        \"data\": \"$data\"
    }
}";
	
	echo $output;
}

function getUserId($name, $password)
{
	global $db;
	$password = md5($password)
	$query = "SELECT user_id FROM game_users WHERE username='$name' AND password='$password'";
	$result = $db->query($query);
	$row = $result->fetch_assoc();	
	return $row['user_id'];
}

function loadSavegame($id)
{
	global $db;

	$query = "SELECT data FROM `game_saves` WHERE user_id='$id' ORDER BY date DESC LIMIT 1";
	$result = $db->query($query);
	$row = $result->fetch_assoc();	
	return $row['data'];
}

function saveSavegame($id, $data)
{
	global $db;
	
	$query = "INSERT INTO `game_saves`(`user_id`, `data`, `date`) VALUES ('$id', '$data', NOW())";
	$result = $db->query($query);
	
	return $result;
}

function registerUser($name, $password, $email, $farm)
{
	global $db;
	$password = md5($password);
	$query = "INSERT INTO `game_users`(`username`, `password`, `email`, `farm`, `date`) VALUES ('$name', '$password', '$email', '$farm', NOW())";
	$result = $db->query($query);

	return $db->insert_id;
}


function userExists($name)
{
	global $db;
	$query = "SELECT user_id FROM game_users WHERE username='$name' LIMIT 1";
	$result = $db->query($query);
	$row = $result->fetch_assoc();	
	return $row['user_id'];
}

function farmExists($name)
{
	global $db;
	$query = "SELECT user_id FROM game_users WHERE farm='$name' LIMIT 1";
	$result = $db->query($query);
	$row = $result->fetch_assoc();	
	return $row['user_id'];
}

function mailExists($email)
{
	global $db;
	$query = "SELECT user_id FROM game_users WHERE email='$email' LIMIT 1";
	$result = $db->query($query);
	$row = $result->fetch_assoc();	
	return $row['user_id'];
}

function filterInput($input)
{
	return htmlspecialchars(trim($input));
}

function sendMail($to, $subject, $message)
{
	
	$headers = "From: contact@DOMAIN\r\n" .
				"X-Mailer: php";
	$res = mail($to , $subject , $message, $headers);

	$success = false;
	if ($res)
	{
		$success = true;
	}
	
	return $success;
}

function getUser($userid)
{
	global $db;
	$query = "SELECT username FROM game_users WHERE user_id='$userid' LIMIT 1";
	$result = $db->query($query);
	$row = $result->fetch_assoc();	
	return $row['username'];	
}

function getFarm($userid)
{
	global $db;
	$query = "SELECT farm FROM game_users WHERE user_id='$userid' LIMIT 1";
	$result = $db->query($query);
	$row = $result->fetch_assoc();	
	return $row['farm'];	
}

function getPassword($userid)
{
	global $db;
	$query = "SELECT password FROM game_users WHERE user_id='$userid' LIMIT 1";
	$result = $db->query($query);
	$row = $result->fetch_assoc();	
	return $row['password'];	
}

function getMail($userid)
{
	global $db;
	$query = "SELECT email FROM game_users WHERE user_id='$userid' LIMIT 1";
	$result = $db->query($query);
	$row = $result->fetch_assoc();	
	return $row['email'];	
}

function getSubdomain()
{
	$subdomain = explode('.',$_SERVER['SERVER_NAME']);

	return $subdomain[0];
}