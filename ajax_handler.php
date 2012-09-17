<?php
require('libs/utils.lib.php');

if (!isset($_GET['mode']))
	die(formatData(false, "Invalid mode"))

//require the functions to be called depending on the mode
require('libs/ajax_endpoints.lib.php');

switch($_GET['mode']) {
	case 'verify':
		switch($_GET['fields']) {
			case 'username':
				echo verifyUsername();
			break;
			case 'email':
				echo verifyEmail();
			break;
			case 'farmname':
				echo verifyFarmname();
			break;
			default:
				echo formatData(false,"Invalid field")
			break;
		}
	break;

	case 'savegame':
		echo saveGame();
	break;

	case 'register':
		echo register();
	break;

	case 'logout':
		echo logout();
	break;

	case 'login':
		echo login();
	break;

	case 'loadGame':
		echo loadgame();
	break;

	case 'isloggedin':
		echo isLoggedIn();
	break;

	case 'forgotpassword':
		echo forgotPassword();
	break;

	default:
		echo formatData(false,"Invalid mode");
	break;
}