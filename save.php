<?php
require 'config.php';
require 'libs/utils.lib.php';
require 'libs/persistance.lib.php';

$facebook = new Facebook(array(
            'appId' => $config["appId"],
            'secret' => $config["secret"],
            'cookie' => true,
            'status' => true,
            'oauth' => true
        ));

// Begin checking registration
try {
  $me = $facebook->getUser();

  if ($me != 0)
  {
    if (isset($_POST["gamestate"])) {
      if (save_game($me, $_POST["gamestate"]) == false) {
        die(mysql_error());
      }
    }
    else {
      die("var gamestate was not set");
    }

  }

}
catch(FacebookApiException $e) {
  die("You are not authorized to enter this area.");
}