<?php

function formatData($status, $data)
{
	return "{ \"result\": { \"status\": \"$status\", \"data\": \"$data\" }	}";
}

function filterInput($input)
{
	return htmlspecialchars(trim($input));
}

function getSubdomain()
{
	return explode('.',$_SERVER['SERVER_NAME'])[0];
}

function sendMail($to, $subject, $message)
{
	$headers = "From: contact@DOMAIN\r\n"."X-Mailer: php";
	$res = mail($to , $subject , $message, $headers);
	return ($res || false);
}