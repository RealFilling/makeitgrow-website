<?php
require_once('session.php');
require_once('settings.php');
global $_THEDOMAIN;

$_SESSION['user_id'] = 0;
unset($_SESSION['user_id']);
header( 'Location: http://www.' . $_THEDOMAIN. '/index.php' );