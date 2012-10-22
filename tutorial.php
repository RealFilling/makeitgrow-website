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
    if (isset($_POST["status"])) {
      if (save_tutorial($me, $_GET["status"]) == false) {
        die(mysql_error());
      }
    }
    else if(isset($_GET["step"])) {
      die(get_tutorial_step($_GET["step"]));
    }
  }

}
catch(FacebookApiException $e) {
  die("You are not authorized to enter this area.");
}