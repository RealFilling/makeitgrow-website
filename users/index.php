<?php
require_once("../config/index.php");
require_once('../libs/index.php');

$relocateURL = "http://www.".DOMAIN."/index.php";

$mode = '';

if (isset($_REQUEST['mode']))
{
	$mode = $_REQUEST['mode'];
}

if (($mode != 'register') && ($mode != 'logout'))
{
	if (isset($_SESSION['user_id']))
	{
		header( 'Location: '.$relocateURL );
		exit;
	}
}

if (isset($_REQUEST['cancel']))
{
	header( 'Location: '.$relocateURL );
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<meta charset="utf-8"/>
		<title>Log in into the Green Dream</title>
		<link type="text/css" href="/assets/css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="Stylesheet" />
		<style>
			.errorMessage {
				color: red;
			}
			#login { font-size: 64%; }
			#registration { font-size: 64%; }
			#forgot { font-size: 64%; }
			h1 { font-size: 1.2em; margin: .6em 0; }			
		</style>
		<script type="text/javascript" src="/assets/js/jquery-1.7.2.js"></script>
		<script type="text/javascript" src="/assets/js/jquery-ui-1.8.21.custom.min.js"></script>
		<script type="text/javascript" src="/assets/js/persistence.js"></script>
	</head>
	<body onload="javascript:prepareDialogs('<?php 
		$mode = '';
		
		if (isset($_REQUEST['mode']))
		{
			$mode = $_REQUEST['mode'];
		}
		if ($mode == 'register')
		{
			echo 'register';
		}
		if ($mode == 'logout')
		{
			echo 'logout';
		}
	?>');">
		<!-- input type="button" value="logout" onclick="javascript:logout()" -->
		<div id="login" style="visibility:hidden;" title="Login">
			<form id="loginform" method="POST" action="javascript:loginSubmit();">
				<table>
				<tr>
					<td>Name</td>
					<td><input type="text" name="name"></td>
					<td><p id="loginformnameerror" class="errorMessage"></p></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password"></td>
					<td><p id="loginformpasserror" class="errorMessage"></p></td>
				</tr>
				<tr>
					<td colspan="3"><input type="submit" name="submit" value="Log in"></td>
				</tr>
				<tr>
					<td colspan="3"><p id="loginformerror" class="errorMessage">&nbsp;</p></td>
				</tr>
			</table>
			</form>
			<a href="#" onclick="javascript:showRegistration();">Register</a> - <a href="#" onclick="javascript:showForgot();">Forgot password?</a>
		</div>
		<div id="registration" style="visibility:hidden;" title="Register">
			<form id="registrationform" method="POST" action="javascript:registrationSubmit();">
				<table>
				<tr>
					<td>Farm name</td>
					<td><input type="text" name="farm" id="farmName"></td>
					<td><p id="registrationformfarmerror" class="errorMessage"></p></td>
				</tr>
				<tr>
					<td>User name</td>
					<td><input type="text" name="name" id="userName"></td>
					<td><p id="registrationformnameerror" class="errorMessage"></p></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password"></td>
					<td><p id="registrationformpasserror" class="errorMessage"></p></td>
				</tr>
				<tr>
					<td>Repeat password</td>
					<td><input type="password" name="pass2"></td>
					<td><p id="registrationformpass2error" class="errorMessage"></p></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><input type="text" name="email" id="emailName"></td>
					<td><p id="registrationformemailerror" class="errorMessage"></p></td>
				</tr>
				<tr>
					<td colspan="3"><input type="submit" name="submit" value="Register"></td>
				</tr>
				<tr>
					<td colspan="3"><p id="registrationformerror" class="errorMessage"></p></td>
				</tr>
			</table>
			</form>
			<a href="#" onclick="javascript:showLogin();">Log in</a> - <a href="#" onclick="javascript:showForgot();">Forgot password?</a>
		</div>
		<div id="forgot" style="visibility:hidden;" title="Forgot your password?">
			<form id="forgotform" method="POST" action="javascript:forgotSubmit();">
				<table>
				<tr>
					<td colspan="2">Enter your farm name or e-mail</td>
				</tr>
				<tr>
					<td>Farm Name</td>
					<td><input type="text" name="farm"></td>
				</tr>
				<tr>
					<td>or</td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><input type="text" name="email"></td>
				</tr>
				<tr>
					<td colspan="2"><p id="forgotformerror" class="errorMessage"></p></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="Resend Password"></td>
				</tr>
			</table>
			</form>
			<a href="#" onclick="javascript:showLogin();">Log in</a> - <a href="#" onclick="javascript:showRegistration();">Register</a>
		</div>
		<div id="forgotconfirmation" style="visibility:hidden;" title="Forgot your password?">
				<table>
				<tr>
					<td>The password has been sent to your e-mail</td>
				</tr>
			</table>
		</div>
		<div id="logout" style="visibility:hidden;" title="Log out">
			<form method="POST">
				<table>
				<tr>
					<td>Are you sure?</td>
				</tr>
			</table>
			</form>
		</div>
		<div id="welcome" style="visibility:hidden;" title="Welcome!">
				<table>
				<tr>
					<td>Welcome to The Green Dream</td>
				</tr>
			</table>
		</div>
	</body>
</html>