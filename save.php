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
    save($me, $_POST["gamestate"]):
  }

}
catch(FacebookApiException $e) {
  die("You are not authorized to enter this area.")
}