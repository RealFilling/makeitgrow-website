<?php
require_once("../config.php");
require_once('../libs/index.php');

$_SESSION['user_id'] = 0;
unset($_SESSION['user_id']);
header( 'Location: http://www.' . DOMAIN. '/index.php' );